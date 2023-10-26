<?php

declare(strict_types=1);

namespace Sun\IPay\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\App;
use Sun\IPay\Dto\RequestDto\BaseRequestDto;
use Sun\IPay\Enum\LanguageEnum;
use Sun\IPay\Exceptions\Request\AbstractResponsableException;
use Sun\IPay\Exceptions\Request\InternalIPayError;
use Sun\IPay\Exceptions\Request\WrongSignatureException;
use Sun\IPay\Http\RequestTypes\RequestTypeFactory;
use Sun\IPay\Http\ResponseGenerators\AbstractIPayXmlGenerator;
use Sun\IPay\Http\Responses\IPayResponse;
use Sun\IPay\Mapper\ArrayObjectMapper;
use Sun\IPay\Service\SignatureService;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class IPayController extends Controller
{
    private const SIGNATURE_HEADER_KEY = 'ServiceProvider-Signature';
    private const XML_REQUEST_KEY = 'XML';

    public function __construct(
        private readonly SignatureService $signatureService,
        private readonly ArrayObjectMapper $arrayObjectMapper,
        private readonly RequestTypeFactory $requestTypeFactory,
    ) {
    }

    public function __invoke(Request $request): Response
    {
        try {
            $xml = $request->input(self::XML_REQUEST_KEY);
            $signature = $this->getSignatureFromHeaders($request) ?? throw new WrongSignatureException($this->signatureService);
            if ($this->signatureService->verify($xml, $signature)) {
                throw new WrongSignatureException($this->signatureService, $signature);
            }
            $data = $this->getDataFromXml($xml);
            $generator = $this->processData($data);

            return (new IPayResponse($generator, $this->signatureService))->toResponse($request);
        } catch (AbstractResponsableException $exception) {
            throw $exception;
        } catch (Throwable $exception) {
            throw new InternalIPayError($exception, $this->signatureService);
        }
    }

    private function processData(array $data): AbstractIPayXmlGenerator
    {
        $baseRequestDto = $this->arrayObjectMapper->deserialize($data, BaseRequestDto::class);
        $locale = LanguageEnum::map($baseRequestDto->getLanguage(), LanguageEnum::RUSSIAN);
        App::setLocale($locale);
        $requestType = $this->requestTypeFactory->createRequestType($baseRequestDto->getRequestType());
        return $requestType->processData($data);
    }

    private function getSignatureFromHeaders(Request $request): ?string
    {
        if (!is_string($signature = $request->header(self::SIGNATURE_HEADER_KEY))) {
            return null;
        }
        if (preg_match('/SALT\+MD5:\s(.*)/', $signature, $matches)) {
            return $matches[1] ?? null;
        }
        return null;
    }

    private function getDataFromXml(string $xml): array
    {
        return json_decode(
            json_encode((array)simplexml_load_string($xml), JSON_THROW_ON_ERROR),
            true,
            flags: JSON_THROW_ON_ERROR
        );
    }
}
