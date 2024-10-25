<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Sarabun', sans-serif;
            font-size: 11.5px;
            margin-left: 40px; /* ระยะห่างจากขอบซ้าย */
            margin-right: 40px; /* ระยะห่างจากขอบขวา */
        }

        h2{
            text-align: center;
            font-size: 13px;

        }
        p{
            font-size: 12px;
        }

        span.username {
            border-bottom: 1px dashed;
            padding-left: 5px;
            padding-right: 100px;
            color: blue;
        }

        span.lastname {
            border-bottom: 1px dashed;
            padding-left: 5px;
            padding-right: 150px;
            color: blue;
        }

        span.occupation {
            border-bottom: 1px dashed;
            padding-left: 10px;
            padding-right: 90px;
            color: blue;
        }

        span.house_number{
            border-bottom: 1px dashed;
            padding-left: 10px;
            padding-right: 50px;
            color: blue;
        }

        span.village{
            border-bottom: 1px dashed;
            padding-left: 10px;
            padding-right: 30px;
            color: blue;
        }

        span.subdistrict{
            border-bottom: 1px dashed;
            padding-left: 10px;
            padding-right: 50px;
            color: blue;
        }
        span.district{
            border-bottom: 1px dashed;
            padding-left: 10px;
            padding-right: 40px;
            color: blue;
        }
        span.province{
            border-bottom: 1px dashed;
            padding-left: 10px;
            padding-right: 20px;
            color: blue;
        }
        span.phone_number{
            border-bottom: 1px dashed;
            padding-left: 10px;
            padding-right: 30px;
            color: blue;
        }
        span.subject{
            border-bottom: 1px dashed;
            padding-left: 10px;
            padding-right: 30px;
            color: blue;
        }
        span.reason{
            border-bottom: 1px dashed;
            padding-left: 10px;
            padding-right: 40px;
            color: blue;
        }
        span.day{
            border-bottom: 1px dashed;
            padding-left: 10px;
            padding-right: 10px;
            color: blue;
        }
        span.month{
            border-bottom: 1px dashed;
            padding-left: 10px;
            padding-right: 10px;
            color: blue;
        }
        span.year{
            border-bottom: 1px dashed;
            padding-left: 10px;
            padding-right: 10px;
            color: blue;
        }
        span.quantity{
            border-bottom: 1px dashed;
            padding-left: 10px;
            padding-right: 50px;
            color: blue;
        }
        span.capacity{
            border-bottom: 1px dashed;
            padding-left: 10px;
            padding-right: 50px;
            color: blue;
        }
        span.username_2{
            border-bottom: 1px dashed;
            padding-left: 10px;
            padding-right: 10px;
            color: blue;
        }
        span.username_3{
            border-bottom: 1px dashed;
            padding-left: 10px;
            padding-right: 10px;
            color: blue;
        }
        span.support_address{
            border-bottom: 1px dashed;
            padding-left: 10px;
            padding-right: 50px;
            color: blue;
        }
    </style>
    <title>PDF Report</title>
</head>
<body>

    <h2>แบบคำร้อง</h2>
    <h2>ขอควมอนุเคระห์ น้ำอุปโภค-บริโภค</h2>
    <h2>สํานักปลัด เทศบลตําบลยุคใหม่ อําเภอยุคใหม่ จังหวัดยุคใหม่</h2>

    <p style="margin-top: 50px; text-align: center;">วันที่ {{ $day }} เดือน {{ $month }} พ.ศ. {{ $year }}</p>

    <p style="margin-top: 20px;">เรื่อง ขอความอนุเคราะห์ น้ำอุปโภค - บริโภค</p>
    <p>เรียน นายกเทศมนตรีตำบลยุคใหม่</p>
    <p style="margin-left: 55px;">ด้วยข้าพเจ้า<span class="username">{{ $request->salutation }}{{ $request->first_name }}</span>นามสกุล<span class="lastname">{{ $request->last_name }}</span></p>
    <p>ตำแหน่ง<span class="occupation">{{ $request->occupation }}</span>อยู่บ้านเลขที่<span class="house_number">{{ $request->house_number }}</span> หมู่ที่ <span class="village">{{ $request->village }}</span>ตำบล<span class="subdistrict">{{ $request->subdistrict }}</span></p>
    <p>อำเภอ <span class="district">{{ $request->district }}</span>จังหวัด <span class="province">{{ $request->province }}</span>หมายเลขโทรศัพท์ที่ติดต่อได้ <span class="phone_number">{{ $request->phone_number }}</span></p>

    <p style="margin-left: 55px;">เรื่อง <span class="subject">{{ $request->subject }}</span>เนื่องจาก<span class="reason">{{ $request->reason }}</span></p>
    <p>สถานที่ขอสนับสนุน(ที่อยู่) <span class="support_address">{{ $request->support_address }}</span></p>
    <p>ยื่นตั้งแต่วันที่ <span class="day">{{ $day }}</span>เดือน <span class="month">{{ $month }}</span>พ.ศ <span class="year">{{ $year }}</span>ระยะเวลาด้ําาเนินการถึงวันที่<span class="day">{{ $day }}</span>เดือน <span class="month">{{ $month }}</span>พ.ศ <span class="year">{{ $year }}</span></p>
    <p>จ้ําานวน <span class="quantity">{{ $request->quantity }}</span>รถ ปริมาณความจุ<span class="capacity">{{ $request->capacity }}</span>ลิตร</p>

    <p style="margin-left: 55px; margin-top:50px">จึงเรียนมาเพื่อทราบและพิจารณาด้ําาเนินการต่อไป</p>
    <p style="text-align: center; margin-top: 30px;">ขอแสดงความนับถือ</p>
    <p style="text-align: center;">( ลงชื่อ<span class="username_2">{{ $request->first_name }} &nbsp;{{ $request->last_name }}</span>)</p>
    <p style="text-align: center;">(<span class="username_3">{{ $request->salutation }}{{ $request->first_name }} &nbsp;{{ $request->last_name }}</span>)</p>
    <p style="text-align: center;">ผู้ยื่นค้ําาร้อง</p>
</body>
</html>
