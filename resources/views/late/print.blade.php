<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukti Pembelian </title>

    <style>
        #back-wrap{
            margin: 30px auto 0 auto;
            width: 500px;
            display: flex;
            justify-content: flex-end;
        }

        .btn-back{
            width: fit-content;
            padding: 8px 15px;
            color: #fff;
            background: #666;
            border-radius: 5px;
            text-decoration: none;
        }
        #receipt{
            box-shadow: 5px 10px 15px rgba(0,0,0,0.5);
            padding: 70px;
            margin: 30px auto 0 auto;
            width: 650px;
            background: #fff;
        }

        h2{ 
            font-size: .9rem;
        }

        p{
            font-size: .8rem;
            color: #666;
            line-height: 1.2rem;
        }

        #top{
            margin-top: 25px;
        }

        #top .info{
            text-align: left;
            margin: 20px 0;
        }

        table{
            width: 100%;
            border-collapse: collapse;
        }

        td{
            padding: 5px 0 5px 15px;
            border: 1px solid #EEE;
        }

        .tabletitle{
            font-size: .5rem;
            background: #EEE;
        }
        .service{
            border-bottom: 1px solid #EEE;
        }

        .itemtext{
            font-size: .7rem;
        }
        
        #legalcopy{
            margin-top: 15px;
        }
        .btn-print{
            float: right;
            color: #333;
        }
        table {
            border-collapse: collapse;
        }
        td, th {
            border: none;
        }
    </style>
</head>
<body>
    <div id ="back-wrap">
        <a href="#" class="btn-back">Kembali </a>
    </div>
    <div id="receipt">
        <a href="{{ route('late.print') }}" class="btn-print">Cetak (.pdf)</a>
            <center id="top">
                <div class="info">
                    <center>   
                        <h2> Surat Penyataan </h2>
                        <h2>Tidak akan terlambat datang kesekolah </h2>
                    </center>
                </div>
            </center>
            <div id="mid">
                <div class="info" style="margin-top: 37px;">
                <div class="container" >
                    <table>
                        <h5 >Yang bertanda tangan di bawah ini :</h5>
                        <tr>
                            <td> NIS</td>
                            <td > : </td>
                            <td>12209468</td>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td > : </td>
                            <td>Saiful KKV</td>
                        </tr>
                        <tr>
                            <td>Rombel</td>
                            <td > : </td>
                            <td>KLN X-1</td>
                        </tr>
                        <tr>
                            <td>Rayon</td>
                            <td > : </td>
                            <td>Ciawi 2</td>
                        </tr>
                    </table>
                </div>
                </div>
            </div>
            <div id="bot">
                <div class="bottom" style="margin-top: 30px;">
                    <p>
                        Dengan ini menyatakan bahwa saya telah melakukan pelanggaran tata tertib sekolah, yaitu 
                        terlambat datang ke sekolah sebanyak <strong>3 Kali</strong> yang mana hal tersebut 
                        termasuk kedalam pelanggaran kedisiplinan. Saya berjanji tidak akan terlambat datang 
                        ke sekolah lagi. Apabila saya terlambat datang ke sekolah lagi saya siap diberikan sanksi 
                        yang sesuai dengan peraturan sekolah.
                    </p>
                </div>
                <div class="legalcopy">
                    <p class="legal">Demikian surat pernyataan terlambat ini saya buat dengan penuh penyesalan.</p>
                </div>
                <table style="margin-top: 50px;">
                    <tr>
                        <td >
                            <center>
                                <p>Peserta didik</p>
                            </center>
                        </td>
                        <td>
                            <center>
                                <p>Bogor ,24 januari 2024</p>
                            </center>
                            <center>
                                <p>Orang Tua / Wali Peserta didik</p>
                            </center>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-top: 50px;">
                            <center>
                                <p>Saiful KKV</p>
                            </center>
                        </td>
                        <td  style="padding-top: 50px;">
                            <center>
                                <p>(...........................)</p>
                            </center>
                        </td>
                    </tr>
                    <tr>
                        <td  style="padding-bottom: 10px;">
                            <center>
                                <p>Pembimbing Siswa</p>
                            </center>
                        </td>
                        <td  style="padding-bottom: 10px;">
                            <center>
                                <p>Kesiswaan</p>
                            </center>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-top: 50px;">
                            <center>
                                <p>PS Ciawi 2</p>
                            </center>
                        </td>
                        <td style="padding-top: 50px;">
                            <center>    
                                <p>(...........................)</p>
                            </center>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</body>
</html>