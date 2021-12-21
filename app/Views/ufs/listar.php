<?= $header ?>
<!--     <?php

            /*     $apiUrl = 'https://mindicador.cl/api/uf';
    //Es necesario tener habilitada la directiva allow_url_fopen para usar file_get_contents
    if (ini_get('allow_url_fopen')) {
        $json = file_get_contents($apiUrl);

    } else {
        //De otra forma utilizamos cURL
        $curl = curl_init($apiUrl);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $json = curl_exec($curl);
        curl_close($curl);
    }
    $dailyIndicators = json_decode($json); */
            ?> -->
<br>
<div class="container">
    <h3>Datos historicos de UF</h3>
    <a class="btn btn-dark" href="<?= base_url('crear') ?>">Crear dato</a>
    <br>
    <br>
    <table class="table table-striped table-dark">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Fecha</th>
                <th scope="col">Valor</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($uf as $ufs) : ?>

                <tr>
                    <td><?php echo $ufs['id'] ?></td>
                    <td><?php echo $ufs['fecha'] ?></td>
                    <td><?php echo $ufs['valor'] ?></td>
                    <td>
                        <a href="<?= base_url('editar/' . $ufs['id']); ?>" class="btn btn-secondary" type="button">Editar</a>
                        <a href="<?= base_url('borrar/' . $ufs['id']); ?>" class="btn btn-danger" type="button">Borrar</a>
                    </td>
                </tr>
            <?php endforeach  ?>
        </tbody>
    </table>
</div>
<br>
<div id="container" class="container">
    <h3>Tipo de indicador económico</h3>
    <select name="select" id="select">
        <option value="" disabled selected>Seleccione..</option>
        <option value="AB">uf</option>
        <option value="AB">ivp</option>
        <option value="AB">dolar</option>
        <option value="AB">dolar_intercambio</option>
        <option value="AB">euro</option>
        <option value="AB">ipc</option>
        <option value="AB">utm</option>
        <option value="AB">imacec</option>
        <option value="AB">tpm</option>
        <option value="AB">libra_cobre</option>
        <option value="AB">tasa_desempleo</option>
        <option value="AB">bitcoin</option>

    </select>
</div>
<?= $footer ?>