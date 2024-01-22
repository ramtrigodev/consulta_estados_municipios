<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">
        <h2 class="text-center">Consultar</h2>
        <form>
            <div class="form-group">
                <label for="estado">Estado:</label>
                <select class="form-control" id="estado" name="estado">
                </select>
            </div>

            <div class="form-group">
                <label for="municipio">Município:</label>
                <select class="form-control" id="municipio" name="municipio">
                </select>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function carregarEstados() {
            $.ajax({
                url: 'https://servicodados.ibge.gov.br/api/v1/localidades/estados',
                dataType: 'json',
                success: function(data) {
                    var selectEstado = $('#estado');
                    $.each(data, function(index, estado) {
                        selectEstado.append('<option value="' + estado.sigla + '">' + estado.nome + '</option>');
                    });
                    atualizarMunicipios();
                },
                error: function(error) {
                    console.log('Erro ao carregar estados:', error);
                }
            });
        }

        function carregarMunicipios(uf) {
            $.ajax({
                url: 'https://servicodados.ibge.gov.br/api/v1/localidades/estados/' + uf + '/municipios',
                dataType: 'json',
                success: function(data) {
                    var selectMunicipio = $('#municipio');
                    selectMunicipio.empty();
                    $.each(data, function(index, municipio) {
                        selectMunicipio.append('<option value="' + municipio.nome + '">' + municipio.nome + '</option>');
                    });
                },
                error: function(error) {
                    console.log('Erro ao carregar municípios:', error);
                }
            });
        }

        function atualizarMunicipios() {
            var estadoSelecionado = $('#estado').val();
            carregarMunicipios(estadoSelecionado);
        }

        $(document).ready(function() {
            carregarEstados();
            $('#estado').change(atualizarMunicipios);
        });
    </script>

</body>

</html>