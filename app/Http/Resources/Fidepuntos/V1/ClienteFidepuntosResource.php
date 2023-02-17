<?php

namespace App\Http\Resources\Fidepuntos\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class ClienteFidepuntosResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'cedula' => $this->cedula,
            'nombre_completo' => $this->nombre_completo,
            'celular' => $this->celular,
            'membresia' => $this->membresia,
            'email' => $this->email,
            'direccion_residencia' => $this->direccion_residencia,
            'ciudad_residencia' => $this->ciudad_residencia,
            'telefono_fijo' => $this->telefono_fijo,
            'barrio_residencia' => $this->barrio_residencia,
            'puntos_total' => $this->puntos_total,
        ];
    }
}
