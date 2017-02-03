<?php

namespace App;

use App\Invoice;
use Illuminate\Database\Eloquent\Model;

class LinkReport extends Model
{
    protected $fillable = [
        'id',
        'hesap_kodu',
        'ba_bs',
        'aciklama',
        'islem_para_birimi',
        'ba',
        'tutar',
        'unvan',
        'vergi_hesap',
        'ulke',
        'evrak_sayisi',
        'doviz_cinsi',
        'doviz_kuru',
        'doviz_tutari'
    ];

    protected $table = 'link_reports';

    public static function generateReport()
    {
        $invoices = Invoice::all();

        $i = 1;

        foreach ($invoices as $invoice) {

            $report = new LinkReport();
            $report->id = $i;
            $report->hesap_kodu = '600 01 01';
            $report->aciklama = $invoice->invoice_number . $invoice->customer_name;
            $report->islem_para_birimi = 'Yerel Para';
            $report->ba = 'A';

            $matrah = round(($invoice->total - $invoice->tax) * $invoice->currency_rate, 2);

            $report->tutar = $matrah;
            $report->unvan = 'Final Four 2017 Alıcılar Hesabı';
            $report->doviz_cinsi = 'EUR';
            $report->doviz_kuru = $invoice->currency_rate;
            $report->doviz_tutari = round(($invoice->total - $invoice->tax), 2);
            $report->transaction_id = $invoice->transaction_id;
            $report->save();
            $i += 3;
        }
    }

    public static function generateKDV()
    {
        $invoices = Invoice::all();

        $i = 2;

        foreach ($invoices as $invoice) {
            $report = new LinkReport();
            $report->id = $i;
            $report->hesap_kodu = '391 01';
            $report->aciklama = $invoice->invoice_number . $invoice->customer_name;
            $report->islem_para_birimi = 'Yerel Para';
            $report->ba = 'A';
            $report->tutar = round(($invoice->tax * $invoice->currency_rate), 2);
            $report->unvan = 'Final Four 2017 Alıcılar Hesabı';
            $report->doviz_cinsi = 'EUR';
            $report->doviz_kuru = $invoice->currency_rate;
            $report->doviz_tutari = round($invoice->tax, 2);
            $report->transaction_id = $invoice->transaction_id;
            $report->save();
            $i += 3;
        }
    }

    public static function generateTotal()
    {
        $invoices = Invoice::all();

        $i = 3;

        foreach ($invoices as $invoice) {
            $report = new LinkReport();
            $report->id = $i;
            $report->hesap_kodu = '120';
            $report->aciklama = $invoice->invoice_number . $invoice->customer_name;
            $report->islem_para_birimi = 'Yerel Para';
            $report->ba = 'B';
            $report->tutar = round(($invoice->total * $invoice->currency_rate), 2);
            $report->unvan = 'Final Four 2017 Alıcılar Hesabı';
            $report->doviz_cinsi = 'EUR';
            $report->doviz_kuru = $invoice->currency_rate;
            $report->doviz_tutari = round($invoice->total, 2);
            $report->transaction_id = $invoice->transaction_id;
            $report->save();
            $i += 3;
        }
    }
}
