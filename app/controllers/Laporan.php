<?php


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Style\Border;


class Laporan extends Controller
{
    public function cetak_tagihan($list)
    {

        //$data['full'] = $this->model('Tagihan_model')->getBelumLunas();
        $data['full'] = $list;
        $data['tambahan'] = $this->model('Tagihan_model')->getTambahan();
        $data['profile'] = $this->model('Master_model')->getprofile();
        foreach ($data['full'] as $user) :
            $userId = 'P' . substr(str_repeat(0, 3) . $user['id_pelanggan'], -3);
            //$tarif = number_format($user['tarif'], 0, '', '.');
            $total = $user['akhir'] - $user['awal'];
            $biaya = $user['tarif'] * $total;
            $biaya = $biaya + $data['tambahan']['tarif_ht'];
            //$biaya = number_format($biaya, 0, '', '.');
            $data['id_baru'][] = $userId;
            //$data['tarif'][] = $tarif;
            $data['total'][] = $total;
            $data['biaya'][] = $biaya;
        endforeach;
        // var_dump($data);
        // die;
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $spreadsheet->getActiveSheet()->getStyle('A1:H2')->getFont()->setSize(14);
        $spreadsheet->getActiveSheet()->getStyle('A1:I5')->getFont()->setBold(TRUE);
        $sheet->mergeCells('A1:H1');
        $sheet->mergeCells('A2:H2');




        foreach (range('A', 'I') as $columnID) {
            $sheet->getColumnDimension($columnID)
                ->setAutoSize(true);
            $sheet->getStyle($columnID)->getAlignment()->setHorizontal('center');
        }


        $sheet->getStyle('A3:B3')->getAlignment()->setHorizontal('left');
        // $sheet->setCellValue('A3', 'BULAN');
        // $sheet->setCellValue('B3', 'JANUARI');


        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->getColumnDimension('E')->setAutoSize(true);
        $sheet->getColumnDimension('F')->setAutoSize(true);
        $sheet->getColumnDimension('G')->setAutoSize(true);
        $sheet->getColumnDimension('H')->setAutoSize(true);


        $sheet->setCellValue('A1', 'LAPORAN TAGIHAN PEMAKAIAN AIR - ' . strtoupper($data['profile']['nama_pam']));
        $sheet->setCellValue('A2', strtoupper($data['profile']['alamat']));



        $sheet->setCellValue('A5', 'NO');
        $sheet->setCellValue('B5', 'PELANGGAN');
        $sheet->setCellValue('C5', 'PERIODE');
        $sheet->setCellValue('D5', 'METER LALU');
        $sheet->setCellValue('E5', 'METER NOW');
        $sheet->setCellValue('F5', 'PEMAKAIAN');
        $sheet->setCellValue('G5', 'HARGA');
        $sheet->setCellValue('H5', 'IURAN');
        $sheet->setCellValue('I5', 'TOTAL');

        $i = 6;
        foreach ($data['full'] as $pelanggan) {
            $sheet->setCellValue('A' . $i, $i - 5);
            $sheet->setCellValue('B' . $i, $data['id_baru'][$i - 6] . ' - ' . $pelanggan['nama']);
            $sheet->setCellValue('C' . $i, $pelanggan['nama_bulan'] . '-' . $pelanggan['tahun']);
            $sheet->setCellValue('D' . $i, $pelanggan['awal']);
            $sheet->setCellValue('E' . $i, $pelanggan['akhir']);
            $sheet->setCellValue('F' . $i, $data['total'][$i - 6]);
            $sheet->setCellValue('G' . $i, $pelanggan['tarif']);
            $sheet->setCellValue('H' . $i, $data['tambahan']['tarif_ht']);
            $sheet->setCellValue('I' . $i, $data['biaya'][$i - 6]);
            $i++;
        }

        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN
                ]
            ]
        ];
        $akhir = $i - 1;

        $sheet->getStyle('A5:I' . $akhir)->applyFromArray($styleArray);

        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . urlencode('Tagihan' . str_replace(' ', '', $data['profile']['nama_pam']) . '.xlsx') . '"');
        $writer->save('php://output');
    }

    public function tagihan()
    {
        $data['bulan'] = $this->model('Tagihan_model')->bulan();
        $data['tahun'] = $this->model('Tagihan_model')->getTahun();
        $this->view('templates/header');
        $this->view('templates/sidebar');
        $this->view('templates/topbar');
        $this->view('laporan/tagihan', $data);
        $this->view('laporan/tagihan_script');
    }


    public function cetaktagihan()
    {

        $data = $this->model('Tagihan_model')->filter($_POST);
        $this->cetak_tagihan($data);
    }

    public function pembukuan()
    {
        $data['bulan'] = $this->model('Tagihan_model')->bulan();
        $data['tahun'] = $this->model('Pembayaran_model')->thnBayar();
        $this->view('templates/header');
        $this->view('templates/sidebar');
        $this->view('templates/topbar');
        $this->view('laporan/pembukuan', $data);
        $this->view('laporan/pembukuan_script');
    }


    public function cetak_buku($list)
    {

        $data['profile'] = $this->model('Master_model')->getprofile();
        $data['rekap'] = $list;


        foreach ($data['rekap'] as $user) :
            $userId = 'P' . substr(str_repeat(0, 3) . $user['id_pelanggan'], -3);
            $data['id_baru'][] = $userId . '-' . $user['nama'] . '|' . $user['kode'] . '-' . $user['tahun'];
        endforeach;

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $spreadsheet->getActiveSheet()->getStyle('A1:G2')->getFont()->setSize(14);
        $spreadsheet->getActiveSheet()->getStyle('A1:F5')->getFont()->setBold(TRUE);
        $sheet->mergeCells('A1:F1');
        $sheet->mergeCells('A2:F2');




        foreach (range('A', 'F') as $columnID) {
            $sheet->getStyle($columnID)->getAlignment()->setHorizontal('center');
        }


        $sheet->getStyle('A3:B3')->getAlignment()->setHorizontal('left');
        // $sheet->setCellValue('A3', 'BULAN');
        // $sheet->setCellValue('B3', 'JANUARI');


        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setWidth(8);
        $sheet->getColumnDimension('E')->setAutoSize(true);
        $sheet->getColumnDimension('F')->setWidth(10);


        $sheet->setCellValue('A1', 'LAPORAN PEMBUKUAN USAHA AIR - ' . strtoupper($data['profile']['nama_pam']));
        $sheet->setCellValue('A2', strtoupper($data['profile']['alamat']));



        $sheet->setCellValue('A5', 'NO');
        $sheet->setCellValue('B5', 'KETERANGAN');
        $sheet->setCellValue('C5', 'TANGGAL');
        $sheet->setCellValue('D5', 'MASUK');
        $sheet->setCellValue('E5', 'KELUAR');
        $sheet->setCellValue('F5', 'SALDO');



        $i = 6;
        $saldo = 0;
        foreach ($data['rekap'] as $rekap) {
            $tgl = substr($rekap['tgl_baru'], 0, 10);
            $sheet->setCellValue('A' . $i, $i - 5);
            if ($rekap['total'] == NULL) {
                $sheet->setCellValue('B' . $i, $data['id_baru'][$i - 6]);
                $sheet->setCellValue('D' . $i, $rekap['uang_masuk']);
                $sheet->setCellValue('E' . $i, '');
                $saldo = $saldo + $rekap['uang_masuk'];
            } else {
                $sheet->setCellValue('B' . $i, $rekap['catatan']);
                $sheet->setCellValue('D' . $i, '');
                $sheet->setCellValue('E' . $i, $rekap['total']);
                $saldo = $saldo - $rekap['total'];
            }
            $sheet->setCellValue('C' . $i, $tgl);

            $sheet->setCellValue('F' . $i, $saldo);
            $i++;
        }

        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN
                ]
            ]
        ];
        $akhir = $i - 1;

        $sheet->mergeCells('A' . $i . ':E' . $i);
        $sheet->setCellValue('A' . $i, 'TOTAL');
        $sheet->setCellValue('F' . $i, $saldo);
        $spreadsheet->getActiveSheet()->getStyle('A' . $i . ':F' . $i)->getFont()->setBold(TRUE);
        $sheet->getStyle('A5:F' . $i)->applyFromArray($styleArray);



        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . urlencode('Pembukuan' . str_replace(' ', '', $data['profile']['nama_pam']) . '.xlsx') . '"');
        $writer->save('php://output');
    }

    public function cetakbuku()
    {
        $data = $this->model('Master_model')->rekap();
        //$data = $this->model('Master_model')->filter($_POST);
        // var_dump($data);
        // die;
        $this->cetak_buku($data);
    }
}
