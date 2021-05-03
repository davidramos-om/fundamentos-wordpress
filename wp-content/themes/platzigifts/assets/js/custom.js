(function ($) {

    console.log("%c Hallo Welt - Ich bin auf WordPress", 'background: #222; color: #bada55');

    $('#categorias-producto').change(function () {
        console.log("cambios en el evento de categorias : " + $(this).find(':selected').val());
        console.log("pg.ajaxurl", pg.ajaxurl);

        $.ajax({
            url: pg.ajaxurl,
            method: "POST",
            data: {
                "action": "filtroProductos",
                "categoria": $(this).find(':selected').val()
            },
            beforeSend: () => {
                $('#resultado-productos').html('Cargando');
            },
            success: function (data) {
                $('#resultado-productos').html('');
                console.log("success al buscar categorias : ", data);
                console.info("typeof data", typeof data);

                let html = "";
                data.forEach(item => {
                    html += `<div class="col-md-4 col-12 my-3">
                        <figure>${item.imagen}</figure>
                        <h4 class="my-2">
                            <a href="${item.link}">${item.titulo}</a>
                        </h4>
                    </div>`;
                });

                $("#resultado-productos").html(html);
            },
            error: (err) => {
                $('#resultado-productos').html('');
                console.error("Ocurrio un error : ", err);
            }
        });
    })

    $(document).ready(function () {

        console.log("%cDocument ready", 'color:white;background:white');
        console.log("pg.ajaxurl", pg.apiurl);

        $.ajax({
            url: pg.apiurl + "novedades/3",
            method: "GET",
            beforeSend: () => {
                $('#resultado-novedades').html('Cargando');
            },
            success: function (data) {
                $('#resultado-novedades').html('');
                console.log("success al buscar categorias : ", data);
                console.info("typeof data", typeof data);

                let html = "";
                data.forEach(item => {
                    html += `<div class="col-md-4 col-12 my-3">
                        <figure>${item.imagen}</figure>
                        <h4 class="my-2">
                            <a href="${item.link}">${item.titulo}</a>
                        </h4>
                    </div>`;
                });

                $("#resultado-novedades").html(html);
            },
            error: (err) => {
                $('#resultado-novedades').html('');
                console.error("Ocurrio un error : ", err);
            }
        });
    })

})(jQuery);