<?php

namespace Sun\IPay\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Sun\IPay\Contracts\IPayServiceContract;
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

class IPayController extends AbstractController
{
    public const ROUTE_NAME = 'ipay.index';

    private const SIGNATURE_HEADER_KEY = 'ServiceProvider-Signature';
    private const XML_REQUEST_KEY = 'XML';

    private IPayServiceContract $iPayService;
    private SignatureService $signatureService;
    private ArrayObjectMapper $arrayObjectMapper;
    private RequestTypeFactory $requestTypeFactory;

    public function __construct(
        IPayServiceContract $iPayService,
        SignatureService $signatureService,
        ArrayObjectMapper $arrayObjectMapper,
        RequestTypeFactory $requestTypeFactory
    ) {
        $this->iPayService = $iPayService;
        $this->signatureService = $signatureService;
        $this->arrayObjectMapper = $arrayObjectMapper;
        $this->requestTypeFactory = $requestTypeFactory;
    }

    public function index(Request $request): Response
    {
        try {
            $xml = $request->input(self::XML_REQUEST_KEY);
            $signature = $this->getSignatureFromHeaders($request);
            if ($this->signatureService->verify($xml, $signature)) {
                throw new WrongSignatureException($signature, $this->signatureService);
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
        /** @var BaseRequestDto $baseRequestDto */
        $baseRequestDto = $this->arrayObjectMapper->deserialize($data, BaseRequestDto::class);
        $locale = LanguageEnum::map($baseRequestDto->getLanguage(), 'ru');
        App::setLocale($locale);
        $requestType = $this->requestTypeFactory->createRequestType($baseRequestDto->getRequestType());
        return $requestType->processData($data);
    }

    private function getSignatureFromHeaders(Request $request): ?string
    {
        if (is_null($signature = $request->header(self::SIGNATURE_HEADER_KEY))) {
            return null;
        }
        if (preg_match('/SALT\+MD5:\s(.*)/', $signature, $matches)) {
            return $matches[1] ?? null;
        }
        return null;
    }

    private function getDataFromXml(string $xml): array
    {
        return json_decode(json_encode((array)simplexml_load_string($xml)), true);
    }
}
