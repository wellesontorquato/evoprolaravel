<?php

namespace App\Helpers;

class TextHelper
{
    public static function tratarGeneroPaciente(string $texto, string $genero): string
    {
        if (strtolower($genero) === 'feminino') {
            return str_replace(
                [
                    'ao(à) paciente', 'o(a) paciente', 'do(a) paciente', 'encontrado(a)', 'orientado(a)',
                    'colaborativo(a)', 'admitido(a)', 'transferido(a)', 'O(a)', 'acompanhado(a)',
                    'acolhido(a)', 'atendido(a)', 'encaminhado(a)', 'beneficiado(a)', 'O(a) mesmo(a)',
                    'pronto(a)', 'aceito(a)', 'solicitado(a)'
                ],
                [
                    'à paciente', 'a paciente', 'da paciente', 'encontrada', 'orientada',
                    'colaborativa', 'admitida', 'transferida', 'A', 'acompanhada',
                    'acolhida', 'atendida', 'encaminhada', 'beneficiada', 'A mesma',
                    'pronta', 'aceita', 'solicitada'
                ],
                $texto
            );
        }

        return str_replace(
            [
                'ao(à) paciente', 'o(a) paciente', 'do(a) paciente', 'encontrado(a)', 'orientado(a)',
                'colaborativo(a)', 'admitido(a)', 'transferido(a)', 'O(a)', 'acompanhado(a)',
                'acolhido(a)', 'atendido(a)', 'encaminhado(a)', 'beneficiado(a)', 'O(a) mesmo(a)',
                'pronto(a)', 'aceito(a)', 'solicitado(a)'
            ],
            [
                'ao paciente', 'o paciente', 'do paciente', 'encontrado', 'orientado',
                'colaborativo', 'admitido', 'transferido', 'O', 'acompanhado',
                'acolhido', 'atendido', 'encaminhado', 'beneficiado', 'O mesmo',
                'pronto', 'aceito', 'solicitado'
            ],
            $texto
        );
    }

    public static function tratarGeneroAcompanhante(string $texto, string $genero): string
    {
        if (strtolower($genero) === 'feminino') {
            return str_replace(
                [
                    'seu(sua) acompanhante', 'ao(à) acompanhante', 'o(a) acompanhante', 'do(a) acompanhante',
                    'acolhido(a)', 'orientado(a)', 'acompanhado(a)', 'encaminhado(a)'
                ],
                [
                    'sua acompanhante', 'à acompanhante', 'a acompanhante', 'da acompanhante',
                    'acolhida', 'orientada', 'acompanhada', 'encaminhada'
                ],
                $texto
            );
        }

        return str_replace(
            [
                'seu(sua) acompanhante', 'ao(à) acompanhante', 'o(a) acompanhante', 'do(a) acompanhante',
                'acolhido(a)', 'orientado(a)', 'acompanhado(a)', 'encaminhado(a)'
            ],
            [
                'seu acompanhante', 'ao acompanhante', 'o acompanhante', 'do acompanhante',
                'acolhido', 'orientado', 'acompanhado', 'encaminhado'
            ],
            $texto
        );
    }

    public static function formatarTexto(string $texto): string
    {
        $frases = preg_split('/\.(\s+)?/', trim($texto));
        $formatadas = [];

        foreach ($frases as $frase) {
            $frase = trim($frase);
            if ($frase) {
                $formatadas[] = ucfirst($frase);
            }
        }

        $resultado = implode('. ', $formatadas);

        if (!str_ends_with($resultado, '.')) {
            $resultado .= '.';
        }

        return $resultado;
    }
}
