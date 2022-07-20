<!DOCTYPE html>
<html lang="fr" class="js">
<meta http-equiv="content-type" content="text/html;charset=UTF-8"/><!-- /Added by HTTrack -->
<head>
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description"
          content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers.">
    <link rel="shortcut icon" href="images/favicon.png">
    <title>Email Templates | DashLite Admin Template</title>
    <link rel="stylesheet" href="{{asset('assets/admins/css/css/dashlite41fe.css')}}">
    <link id="skin-default" rel="stylesheet" href="{{asset('assets/admins/css/css/theme41fe.css')}}">
    <link rel="stylesheet" href="{{asset('assets/admins/css/css/style-email.css')}}">
</head>
<body class="nk-body bg-lighter npc-default has-sidebar ">
<div class="nk-app-root">
    <div class="nk-main ">
        <div class="nk-wrap ">
            <div class="nk-content ">
                <div class="container-fluid">
                    <div class="nk-content-inner">
                        <div class="nk-content-body">
                            <div class="content-page wide-md m-auto">

                                <div class="nk-block">
                                    <div class="card">
                                        <div class="card-inner">
                                            <table class="email-wraper">
                                                <tr>
                                                    <td class="py-5">
                                                        <table class="email-header">
                                                            <tbody>
                                                            <tr>
                                                                <td class="text-center pb-4"><a href="#"><img
                                                                            class="email-logo"
                                                                            src="{{asset('favicon.ico')}}"
                                                                            alt="vinco-education-logo"></a>
                                                                    <p class="email-title">
                                                                        VINCO EDUCATION INSTITUTION REGISTER
                                                                    </p>
                                                                </td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                        <table class="email-body">
                                                            <tbody>
                                                            <tr>
                                                                <td class="p-3 p-sm-5"><p><strong>Bonjour {{$name}}</strong>,
                                                                    </p>
                                                                    <p>
                                                                        Nous avons reçu votre demande d'inscription de votre instiution
                                                                        au programme VINCO Education.
                                                                        <br>
                                                                        Nous allons vous recontacter dans le plus bref de délais pour
                                                                        vous informer de la suite du processus d'admission.
                                                                    </p>

                                                                    <p>
                                                                        Pour plus d'information, ecrivez-nous a cet email ou contactez-nous par
                                                                        téléphone au <a href="tel:+243818045132"> +243 818 045 132</a>
                                                                    </p>
                                                                </td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                        <table class="email-footer">
                                                            <tbody>
                                                            <tr>
                                                                <td class="text-center pt-4"><p
                                                                        class="email-copyright-text">Copyright © {{\Carbon\Carbon::getLocale()}}
                                                                        Vinco Education. All rights reserved. <br>
                                                                    </p>
                                                                </td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{asset('assets/admins/js/bundle41fe.js')}}"></script>
<script src="{{asset('assets/admins/js/scripts41fe.js?ver=3.0.1')}}"></script>
<script src="{{asset('assets/admins/js/demo-settings41fe.js?ver=3.0.1')}}"></script>
</body>
</html>
