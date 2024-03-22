<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <title>Vega Welcome!</title>
    <link rel="stylesheet" href="static/bootstrap/css/bootstrap.min.css">
    <link crossorigin="" rel="shortcut icon" type="image/x-icon" href="static/image/web.ico">
    <link rel="stylesheet" href="static/apexcharts/apexcharts.css">
    <script src="static/js/jquery-3.5.1.min.js"></script>
    <script src="static/bootstrap/js/bootstrap.min.js"></script>
    <script src="static/apexcharts/apexcharts.min.js"></script>
    <style>
        body {
            background: #f6f9fe;
        }

        .container-fluid {
            padding-top: 3rem;
        }

        .number {
            display: flex;
            height: 5rem;
            justify-content: center;
            align-items: center;
            background-image: linear-gradient(to right, #fad0c4 0%, #fad0c4 1%, #ffd1ff 100%);
        }

        .beian {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 3rem;
            margin-bottom: 0.5rem;
        }
        .beian a{
            text-decoration: none;
            color: #000;
        }
        .link:hover{
            cursor:pointer;
        }
        .link a
        {
            font-size: 1.5rem;
        }
    </style>
    <script>
        let colors = [
            '#008FFB',
            '#00E396',
            '#FEB019',
            '#FF4560',
            '#775DD0',
            '#546E7A',
            '#26a69a',
            '#D10CE8'
        ];
    </script>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col"></div>
        <div class="col-8">
            <h1>常用网站</h1>
        </div>
        <div class="col"></div>
    </div>
    <div class="row" style="margin-top: 3rem">
        <div class="col"></div>
        <div class="col-2">
            <div class="card number link">
                <a href="https://member.dfoneople.com/register">美服地下城注册账号</a>
            </div>
        </div>
        <div class="col-2">
            <div class="card number link">
                <a href="https://neople.zendesk.com/hc/en-us/requests/new">美服地下城提交申述</a>
            </div>
        </div>
        <div class="col-2">
            <div class="card number link">
                <a href="https://login.live.com/login.srf?wa=wsignin1.0&rpsnv=22&ct=1711011052&rver=7.0.6738.0&wp=MBI_SSL&wreply=https%3a%2f%2foutlook.live.com%2fowa%2f%3fnlp%3d1%26cobrandid%3dab0455a0-8d03-46b9-b18b-df2f57b9e44c%26culture%3dzh-cn%26country%3dcn%26RpsCsrfState%3d817de2d9-12d1-f7f8-1b2c-fd00c145b25e&id=292841&aadredir=1&CBCXT=out&lw=1&fl=dob%2cflname%2cwld&cobrandid=ab0455a0-8d03-46b9-b18b-df2f57b9e44c">微软邮箱登录</a>
            </div>
        </div>
        <div class="col-2">
            <div class="card number link">
                <a href="https://translate.google.com/">谷歌翻译</a>
            </div>
        </div>
        <div class="col"></div>
    </div>
    <div class="row" style="margin-top: 3rem">
        <div class="col"></div>
        <div class="col-8">
            <h1>中控台导航</h1>
        </div>
        <div class="col"></div>
    </div>
    <div class="row" style="margin-top: 3rem">
        <div class="col"></div>
        <div class="col-2">
            <div class="card number link">
                <a href="{{url('/admin')}}">登录入口</a>
            </div>
        </div>
        <div class="col"></div>
    </div>
</div>
</body>
</html>
