<?php

namespace Sun\IPay\Services;

use Carbon\Carbon;
use DB;

class IPayService implements IPayServiceContract
{
    public function orderExist($orderId): bool
    {
        return DB::table('order')->where('order.id', '=', $orderId)->exists();
    }

    public function orderAvailablePayment($orderId): bool
    {
        $tickets = DB::table('order')
            ->select('order.id', 'ticket.id as ticket_id', 'status.code')
            ->join('ticket', 'ticket.order_id', '=', 'order.id')
            ->join('status', 'status.id', '=', 'ticket.status_id')
            ->where('order.id', '=', $orderId)
            ->get();

        return $tickets->contains('code', '=', 'booked');
    }

    public function calculateAmount($orderId)
    {
        $tickets = DB::table('order')
            ->select('ticket.id', 'ticket.amount')
            ->join('ticket', 'ticket.order_id', '=', 'order.id')
            ->join('status', 'status.id', '=', 'ticket.status_id')
            ->where('status.code', '=', 'booked')
            ->where('order.id', '=', $orderId)
            ->get();

        //TODO: may be convert to byn or return currency
        return $tickets->sum('amount');
    }

    public function getPayerName($orderId): string
    {
        return DB::table('order')
            ->select('user.name')
            ->join('user', 'user.id', '=', 'order.user_id')
            ->where('order.id', '=', $orderId)
            ->first()->name;
    }

    public function getPayerSurname($orderId): string
    {
        return DB::table('order')
            ->select('user.surname')
            ->join('user', 'user.id', '=', 'order.user_id')
            ->where('order.id', '=', $orderId)
            ->first()->surname;
    }

    public function lockOrder($orderId, $requestId): bool
    {
        try {
            DB::table('ipay')
                ->insert([
                    'order_id' => $orderId,
                    'request_id' => $requestId,
                ]);

            return true;
        } catch (\Exception $ex) {
            return false;
        }
    }

    public function unlockOrder($orderId): bool
    {
        $count = DB::table('ipay')
            ->where('order_id', '=', $orderId)
            ->count();

        if ($count == 0) {
            return false;
        }

        DB::table('ipay')
            ->where('order_id', '=', $orderId)
            ->delete();

        return true;
    }

    public function payOrder($orderId)
    {
        $status = DB::table('status')
            ->select('status.id')
            ->where('status.code', '=', 'payed')
            ->first();

        DB::table('ticket')
            ->where('ticket.order_id', '=', $orderId)
            ->join('status', 'status.id', '=', 'ticket.status_id')
            ->where('status.code', '=', 'booked')
            ->update(['status_id' => $status->id]);

        $amount = $this->calculateAmount($orderId);

        $paymentType = DB::table('payment_type')
            ->select('payment_type.id')
            ->where('payment_type.code', '=', 'erip')
            ->first();

        DB::table('payment')
            ->insert([
                'created_at' => Carbon::now(),
                'payment_type_id' => $paymentType->id,
                'order_id' => $orderId,
                'amount' => $amount,
            ]);
    }
}
