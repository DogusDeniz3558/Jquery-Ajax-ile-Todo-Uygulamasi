<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Yapılacaklar Uygulaması</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="../../jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
          integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>

    <!-- toastr css ve js -->
    <link rel="stylesheet" href="toastr/toastr.min.css">
    <script src="toastr/toastr.min.js"></script>

    <link rel="stylesheet" href="style.css">
    <style>
        .completed div {
            text-decoration: line-through;
            text-decoration-color: #134c75 !important;
        }

    </style>

</head>
<body class="container">

<!--//Toast Uyarı Penceresi-->

<div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
        <strong class="mr-auto">Başarılı!</strong>
        <small class="text-muted"></small>
        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="toast-body">
        İsteğiniz başarıyla tamamlandı!
    </div>
</div>


<div class="page-content page-container" id="page-content">
    <div class="padding">
        <div class="row container d-flex justify-content-center">
            <div class="col-md-12">
                <div class="card px-3">
                    <div class="card-body">
                        <h4 class="card-title">Yapılacaklar Listesi</h4>
                        <div class="add-items d-flex">
                            <input id="gorev" type="text" class="form-control todo-list-input"
                                   placeholder="Bugün Neye İhtiyacın Var?">
                            <button id="gorevekle" class="add btn btn-primary font-weight-bold todo-list-add-btn">Ekle
                            </button>
                        </div>
                        <div class="list-wrapper">
                            <ul id="liste" class="d-flex flex-column-reverse todo-list">

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            Created By : Doğuş Deniz
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>

<script>

    //Görevleri Listele
    function listele() {
        $.ajax({
            method: "POST",
            url: "api/gorevler-listele.php",
            success: function (result) {
                var data = JSON.parse(result);
                var html = '';
                $.each(data, function (index, value) {
                    html += '<li class="' + (value.durum == 1 ? 'completed' : '') + '">' +
                        '<div class="form-check"><label class="form-check-label">' +
                        '<input id="Gorevdurum" class="checkbox" type="checkbox" value="' + value.id + '" ' +
                        (value.durum == 0 ? '' : 'checked') + '>' + value.gorevler +
                        '<i class="input-helper"></i></label></div>' +
                        '<i class="remove fa-solid fa-xmark" data-id="' + value.id + '"></i></li>';
                });
                $('#liste').html(html);
            },
            error: function (jqXHR, exception) {
                var msg = '';
                if (jqXHR.status === 0) {
                    msg = 'Bağlantı Yok.\n İnternetinizi Kontrol Edin';
                } else if (jqXHR.status == 404) {
                    msg = 'İstek atılan sayfa bulunamadı. [404]';
                } else if (jqXHR.status == 500) {
                    msg = 'İç Sunucu Hatası [500].';
                } else if (exception === 'parsererror') {
                    msg = 'İstenen JSON ayrıştırması başarısız oldu.';
                } else if (exception === 'timeout') {
                    msg = 'Zaman Aşımı hatası.';
                } else if (exception === 'abort') {
                    msg = 'Ajax isteği iptal edildi.';
                } else {
                    msg = 'Uncaught Error.\n' + jqXHR.responseText;
                }
                alert(msg);
            }
        });
    }

    $(document).ready(function () {
        listele();
        setInterval(listele, 1000); // 10 saniyede bir güncelleme yapmak için
    });

    (function ($) {
        'use strict';
        $(function () {
            var todoListItem = $('.todo-list');
            $('.todo-list-add-btn').on("click", function (event) {
                event.preventDefault();


                // Görev Ekleme Alanı
                $.ajax({
                    method: "POST",
                    url: "api/todo-ekle.php",
                    data: {
                        'gorev': $('#gorev').val()
                    },
                    success: function (response) {
                        if (response == "Eklendi") {
                            toastr["success"]("Tebrikler. İhtiyacınız Ekledi!", "İçerik Ekleme Başarılı");
                        } else if (response == "Eklenmedi") {
                            toastr["error"]("İçerik Ekleme Başarısız. Sistem Yöneticisine Başvurunuz! Hata : 4", "Ekleme Başarısız!");
                        } else if (response == "Boş") {
                            toastr["warning"]("Lütfen Bir İhtiyaç Giriniz!", "Boş Veri!");
                        }
                    },
                    error: function (jqXHR, exception) {
                        var msg = '';
                        if (jqXHR.status === 0) {
                            msg = 'Bağlantı Yok.\n İnternetinizi Kontrol Edin';
                        } else if (jqXHR.status == 404) {
                            msg = 'İstek atılan sayfa bulunamadı. [404]';
                        } else if (jqXHR.status == 500) {
                            msg = 'İç Sunucu Hatası [500].';
                        } else if (exception === 'parsererror') {
                            msg = 'İstenen JSON ayrıştırması başarısız oldu.';
                        } else if (exception === 'timeout') {
                            msg = 'Zaman Aşımı hatası.';
                        } else if (exception === 'abort') {
                            msg = 'Ajax isteği iptal edildi.';
                        } else {
                            msg = 'Uncaught Error.\n' + jqXHR.responseText;
                        }
                        alert(msg);
                    }
                });

            });


            //Checkbox işlemleri
            todoListItem.on('change', '.checkbox', function () {
                //Eğer checked varsa completed klası ekle yoksa kaldır
                if ($(this).is(':checked')) {
                    $(this).closest('li').addClass('completed');
                } else {
                    $(this).closest('li').removeClass('completed');
                }

                var id = $(this).val();
                if ($(this).is(':checked')) {
                    var durum = "true"
                } else {
                    var durum = "false"
                }
                if ($(this).attr('checked')) {
                    $(this).removeAttr('checked');
                    $.ajax({
                        method: "POST",
                        url: "api/gorevler-yapildi-durumu.php",
                        data: {
                            "id": id,
                            "durum": durum
                        },
                        success: function (sonuc) {

                        },
                    });
                } else {
                    $(this).attr('checked', 'checked');
                    $.ajax({
                        method: "POST",
                        url: "api/gorevler-yapildi-durumu.php",
                        data: {
                            "id": id,
                            "durum": durum
                        },
                        success: function (sonuc) {

                        },
                    });
                }


            });


            // Çarpı işaretine bastığımız alan
            todoListItem.on('click', '.remove', function () {
                $(this).parent().remove();
                var id = $(this).data('id');
                $.ajax({
                    method: "POST",
                    url: "api/gorevler-sil.php",
                    data: {
                        "id": id
                    },
                    success: function (res) {
                        if (res == "Silindi"){
                            toastr["success"]("", "İçerik Silme Başarılı");
                        }
                    }
                });

            });

        });


        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
    })(jQuery);


</script>
</body>
</html>