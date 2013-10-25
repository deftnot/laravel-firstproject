<?php

class Perfil extends Eloquent {

    protected $table = "perfiles";

    /**
     * Agrega un nuevo perfil creando su Codigo QR y guardando la imagen en la bd
     * @param String $qrContent Contendo que tendra el codigo QR
     * @param type $Name Nombre que tendra el perfil
     */
    public function addPerfil($contenido, $titulo) {
        $pdo = DB::connection()->getPdo();
        try {
            $pdo->beginTransaction();
            $qrCode = new Endroid\QrCode\QrCode();
            $path = app_path('assets/images/qr/');
            $qrCode->setText($contenido);
            $qrName = \uniqid() . '.png';
            $qrCode->save($path . $qrName);
            $oImagen = new Imagen;
            $oImagen->nombre = $qrName;
            $oImagen->tipo = 'qr';
            $oImagen->save();
            $this->titulo = $titulo;
            $this->imagen_id = $oImagen->id;
            $this->usuario_id = Auth::user()->id;
            $this->save();
            $pdo->commit();
            return true;
        } catch (Exception $ex) {
            $pdo->rollBack();
            return false;
        }
    }

}
