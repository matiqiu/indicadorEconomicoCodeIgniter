<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UfModel;

class UfController extends Controller
{
    public function index()
    {
        $uf = new UfModel($db);

        $obtenerApi = $uf->whereIn('id', [1,5,11,19,28])->find();

        //Condición para agregar los datos de la api una sola vez
        if (!$obtenerApi) {

            $apiUrl = 'https://mindicador.cl/api/uf';
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
            $dailyIndicators = json_decode($json);
            foreach ($dailyIndicators->serie as $item) {
                $data = [
                    'fecha' => $item->fecha,
                    'valor' => $item->valor
                ];

                $uf->save($data);
            }
        }
        $datos['uf'] = $uf->orderBy('id', 'ASC')->findAll();

        $datos['header'] = view('estructura/header');
        $datos['footer'] = view('estructura/footer');

        return view('ufs/listar', $datos);
    }
    public function grafico()
    {
        $datos['header'] = view('estructura/header');
        $datos['footer'] = view('estructura/footer');
        return view('grafico', $datos);
    }

    public function crear()
    {

        $datos['header'] = view('estructura/header');
        $datos['footer'] = view('estructura/footer');

        return view('ufs/crear', $datos);
    }
    public function guardar()
    {
        $uf = new UfModel($db);

        $validacion = $this->validate([
            'fecha' => 'required|min_length[5]',
            'valor' => 'required|min_length[3]'
        ]);
        if (!$validacion) {
            $session = session();
            $session->setFlashdata('mensaje', 'El minimo de fecha es de 5 carácteres y de valor es de 3');

            return redirect()->back()->withInput();
        }

        $fecha = $this->request->getVar('fecha');
        $valor = $this->request->getVar('valor');

        $datos = [
            'fecha' => $fecha,
            'valor' => $valor
        ];

        $uf->insert($datos);

        print_r($fecha);
        print_r($valor);

        return $this->response->redirect(site_url('/listar'));
    }
    public function borrar($id = null)
    {
        $uf = new UfModel();
        //$datoUf = $uf->where('id',$id)->first();

        $uf->where('id', $id)->delete($id);

        return $this->response->redirect(site_url('/listar'));
    }
    public function editar($id = null)
    {
        $uf = new UfModel();
        $datos['uf'] = $uf->where('id', $id)->first();

        $datos['header'] = view('estructura/header');
        $datos['footer'] = view('estructura/footer');

        return view('ufs/editar', $datos);
    }
    public function actualizar()
    {
        $uf = new UfModel();

        $validacion = $this->validate([
            'fecha' => 'required|min_length[5]',
            'valor' => 'required|min_length[3]'
        ]);
        if (!$validacion) {
            $session = session();
            $session->setFlashdata('mensaje', 'El minimo de fecha es de 5 carácteres y de valor es de 3');

            return redirect()->back()->withInput();
        }

        $fecha = $this->request->getVar('fecha');
        $valor = $this->request->getVar('valor');
        $id = $this->request->getVar('id');

        $datos = [
            'fecha' => $fecha,
            'valor' => $valor
        ];

        $uf->update($id, $datos);

        return $this->response->redirect(site_url('/listar'));
    }
}
