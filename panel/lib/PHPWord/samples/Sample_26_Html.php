<?php
include_once 'Sample_Header.php';

// New Word Document
echo date('H:i:s') , ' Create new PhpWord object' , EOL;
$phpWord = new \PhpOffice\PhpWord\PhpWord();

$section = $phpWord->addSection();
$html = '<h1>Adding element via HTML</h1>';
$html .= '<p>Some well formed HTML snippet needs to be used</p>';
$html .= '<p>With for example <strong>some<sup>1</sup> <em>inline</em> formatting</strong><sub>1</sub></p>';
$html .= '<p>Unordered (bulleted) list:</p>';
$html .= '<ul><li>Item 1</li><li>Item 2</li><ul><li>Item 2.1</li><li>Item 2.1</li></ul></ul>';
$html .= '<p>Ordered (numbered) list:</p>';
$html .= '<ol><li>Item 1</li><li>Item 2</li></ol>';
$html .= '
<table>
		<tr><td colspan="3"><b><u>MAHMOD JAYA-INA</u></b></td></tr>
		<tr><td colspan="3">Jumat, 15 April 2016 pukul 10:30 </td></tr>
		<tr><td colspan="3">&nbsp;</td></tr>
		<tr><td class="kolom-judul">Nama Pemilik Kapal</td><td style="width:10px" class="kolom-titik2">:</td><td class="kolom-isi">Mahmod Jaya</td></tr>
		<tr><td class="kolom-judul">TW</td><td style="width:10px" class="kolom-titik2">:</td><td class="kolom-isi">0415.10.30</td></tr>
		<tr><td class="kolom-judul">Kapal TNI AL</td><td style="width:10px" class="kolom-titik2">:</td><td class="kolom-isi">AJK-653</td></tr>
		<tr><td class="kolom-judul">Lintang</td><td style="width:10px" class="kolom-titik2">:</td><td class="kolom-isi">104°   LS</td></tr>
		<tr><td class="kolom-judul">Bujur</td><td style="width:10px" class="kolom-titik2">:</td><td class="kolom-isi">104°  BS</td></tr>
		<tr><td class="kolom-judul">Jenis Kapal</td><td style="width:10px" class="kolom-titik2">:</td><td class="kolom-isi">Kayu</td></tr>
		<tr><td class="kolom-judul">Bobot K</td><td style="width:10px" class="kolom-titik2">:</td><td class="kolom-isi">9888</td></tr>
		<tr><td class="kolom-judul">Nomor Registrasi</td><td style="width:10px" class="kolom-titik2">:</td><td class="kolom-isi">83737388373737</td></tr>
		<tr><td class="kolom-judul">Nahkoda</td><td style="width:10px" class="kolom-titik2">:</td><td class="kolom-isi">SAMSUL</td></tr>
		<tr><td class="kolom-judul">Nama Perusahaan</td><td style="width:10px" class="kolom-titik2">:</td><td class="kolom-isi">Tanurah</td></tr>
		<tr><td class="kolom-judul">Alamat Perusahaan</td><td style="width:10px" class="kolom-titik2">:</td><td class="kolom-isi">Jl kusuma bagnsa no skdjfalsdfj alsdfj alskdfj </td></tr>
		<tr><td class="kolom-judul">Telp/Fax</td><td style="width:10px" class="kolom-titik2">:</td><td class="kolom-isi">09992929292</td></tr>
		<tr><td colspan="3">&nbsp;</td></tr>
		</table>
';
\PhpOffice\PhpWord\Shared\Html::addHtml($section, $html);

// Save file
echo write($phpWord, basename(__FILE__, '.php'), $writers);
if (!CLI) {
    include_once 'Sample_Footer.php';
}
