<footer class="footer">
    <div class="container-fluid">
        <div class="row text-muted">
            <div class="col-8 text-left">
                <ul class="list-inline">
                    <li class="list-inline-item">
                        <a class="text-muted" href="#">Support</a>
                    </li>
                    <li class="list-inline-item">
                        <a class="text-muted" href="#">Privacy</a>
                    </li>
                    <li class="list-inline-item">
                        <a class="text-muted" href="#">Terms of Service</a>
                    </li>
                    <li class="list-inline-item">
                        <a class="text-muted" href="#">Contact</a>
                    </li>
                </ul>
            </div>
            <div class="col-4 text-right">
                <p class="mb-0">
                    &copy; 2021 - <a href="dashboard-default.html" class="text-muted">IT MAWAR</a>
                </p>
            </div>
        </div>
    </div>
</footer>
</div>

</div>

<svg width="0" height="0" style="position:absolute">
    <defs>
        <symbol viewBox="0 0 512 512" id="ion-ios-pulse-strong">
            <path d="M448 273.001c-21.27 0-39.296 13.999-45.596 32.999h-38.857l-28.361-85.417a15.999 15.999 0 0 0-15.183-10.956c-.112 0-.224 0-.335.004a15.997 15.997 0 0 0-15.049 11.588l-44.484 155.262-52.353-314.108C206.535 54.893 200.333 48 192 48s-13.693 5.776-15.525 13.135L115.496 306H16v31.999h112c7.348 0 13.75-5.003 15.525-12.134l45.368-182.177 51.324 307.94c1.229 7.377 7.397 11.92 14.864 12.344.308.018.614.028.919.028 7.097 0 13.406-3.701 15.381-10.594l49.744-173.617 15.689 47.252A16.001 16.001 0 0 0 352 337.999h51.108C409.973 355.999 427.477 369 448 369c26.511 0 48-22.492 48-49 0-26.509-21.489-46.999-48-46.999z">
            </path>
        </symbol>
    </defs>
</svg>
<script src="<?= BASEURL; ?>/public/js/app.js"></script>


<style>
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    input[type=number] {
        -moz-appearance: textfield;
    }
</style>

<script>
    $(function() {

        $(".select2").each(function() {
            $(this)
                .wrap("<div class=\"position-relative\"></div>")
                .select2({
                    dropdownParent: $(this).parent()
                });
        });

        $(".selectbulan").each(function() {
            $(this)
                .wrap("<div class=\"position-relative\"></div>")
                .select2({
                    dropdownParent: $(this).parent()
                });
        });

        $("#id_pel").change(function() {
            var id_pel = $(this).val();

            $.ajax({
                url: '<?= BASEURL; ?>' + '/tagihan/getbulanpelanggan',
                data: {
                    id_pel: id_pel
                },
                method: 'post',
                dataType: 'json',
                success: function(data) {
                    $("#bulan").removeAttr('value');
                    $("#bulan").empty();
                    
                    if(data.sudah.length!=0)
                    {
                        var sudah = data.sudah[data.sudah.length - 1];
                        for (bul in data.bulan) {
                            if ((sudah.id_bulan + 1) == data.bulan[bul].id_bulan) {
                                $("#bulan").append('<option value = "' + data.bulan[bul].id_bulan + '" selected>' + data.bulan[bul].nama_bulan + '</option>')
                            } else {
    
                                $("#bulan").append('<option value = "' + data.bulan[bul].id_bulan + '" >' + data.bulan[bul].nama_bulan + '</option>');
                            }
                        };
                    }
                    else
                    {
                        for (bul in data.bulan) {
                                $("#bulan").append('<option value = "' + data.bulan[bul].id_bulan + '" >' + data.bulan[bul].nama_bulan + '</option>');
                        }
                            
                    }

                    
                    //untukmeteranterakhir
                    var bulan = $("#bulan").val();

                    $.ajax({
                        url: '<?= BASEURL; ?>' + '/tagihan/getmeterakhir',
                        data: {
                            bulan: bulan,
                            id_pel: id_pel
                        },
                        method: 'post',
                        dataType: 'json',
                        success: function(data) {
                            $("#m_awal").val(data.akhir);
                        }
                    });
                    
                }
            });


            $.ajax({
                url: '<?= BASEURL; ?>' + '/tagihan/gethargapelanggan',
                data: {
                    id_pel: id_pel
                },
                method: 'post',
                dataType: 'json',
                success: function(data) {
                    $("#harga").val(data.tarif);
                }
            });



        });

        $("#bulan").change(function() {
            var bulan = $(this).val();
            var id_pel = $("#id_pel").val();
            $.ajax({
                url: '<?= BASEURL; ?>' + '/tagihan/getmeterakhir',
                data: {
                    bulan: bulan,
                    id_pel: id_pel
                },
                method: 'post',
                dataType: 'json',
                success: function(data) {
                    $("#m_awal").val(data.akhir);
                }
            })
        });



    });
</script>
</body>

</html>