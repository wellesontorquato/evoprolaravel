<?php

namespace App\Helpers;

class TextHelper
{
    public static function tratarGeneroPaciente(string $texto, ?string $genero): string
    {
        if (strtolower($genero ?? '') === 'feminino') {
            return str_replace(
                [
                    'ao(à) paciente', 'o(a) paciente', 'do(a) paciente', 'encontrado(a)', 'orientado(a)',
                    'colaborativo(a)', 'admitido(a)', 'transferido(a)', 'O(a)', 'acompanhado(a)',
                    'acolhido(a)', 'atendido(a)', 'encaminhado(a)', 'beneficiado(a)', 'O(a) mesmo(a)',
                    'pronto(a)', 'aceito(a)', 'solicitado(a)', 'Acompanhado(a)', 'Acompanhado(a) por',
                    'visitado(a)', 'seu(sua)'
                ],
                [
                    'à paciente', 'a paciente', 'da paciente', 'encontrada', 'orientada',
                    'colaborativa', 'admitida', 'transferida', 'A', 'acompanhada',
                    'acolhida', 'atendida', 'encaminhada', 'beneficiada', 'A mesma',
                    'pronta', 'aceita', 'solicitada', 'Acompanhada', 'Acompanhada por',
                    'visitada', 'sua'
                ],
                $texto
            );
        }

        return str_replace(
            [
                'ao(à) paciente', 'o(a) paciente', 'do(a) paciente', 'encontrado(a)', 'orientado(a)',
                'colaborativo(a)', 'admitido(a)', 'transferido(a)', 'O(a)', 'acompanhado(a)',
                'acolhido(a)', 'atendido(a)', 'encaminhado(a)', 'beneficiado(a)', 'O(a) mesmo(a)',
                'pronto(a)', 'aceito(a)', 'solicitado(a)', 'Acompanhado(a)', 'Acompanhado(a) por',
                'visitado(a)', 'seu(sua)'
            ],
            [
                'ao paciente', 'o paciente', 'do paciente', 'encontrado', 'orientado',
                'colaborativo', 'admitido', 'transferido', 'O', 'acompanhado',
                'acolhido', 'atendido', 'encaminhado', 'beneficiado', 'O mesmo',
                'pronto', 'aceito', 'solicitado', 'Acompanhado', 'Acompanhado por',
                'visitado', 'seu'
            ],
            $texto
        );
    }

    public static function tratarGeneroAcompanhante(string $texto, ?string $genero): string
    {
        if (strtolower($genero ?? '') === 'feminino') {
            return str_replace(
                [
                    'seu(sua) acompanhante', 'ao(à) acompanhante', 'o(a) acompanhante', 'do(a) acompanhante',
                    'acolhido(a)', 'orientado(a)', 'acompanhado(a)', 'encaminhado(a)',
                    'O(a) acompanhante', 'o(a) acompanhante', 'O acompanhante é do sexo'
                ],
                [
                    'sua acompanhante', 'à acompanhante', 'a acompanhante', 'da acompanhante',
                    'acolhida', 'orientada', 'acompanhada', 'encaminhada',
                    'A acompanhante', 'a acompanhante', 'A acompanhante é do sexo'
                ],
                $texto
            );
        }

        return str_replace(
            [
                'seu(sua) acompanhante', 'ao(à) acompanhante', 'o(a) acompanhante', 'do(a) acompanhante',
                'acolhido(a)', 'orientado(a)', 'acompanhado(a)', 'encaminhado(a)',
                'O(a) acompanhante', 'o(a) acompanhante', 'A acompanhante é do sexo'
            ],
            [
                'seu acompanhante', 'ao acompanhante', 'o acompanhante', 'do acompanhante',
                'acolhido', 'orientado', 'acompanhado', 'encaminhado',
                'O acompanhante', 'o acompanhante', 'O acompanhante é do sexo'
            ],
            $texto
        );
    }

    public static function ajustarParentesco(string $parentesco, ?string $genero): string
    {
        $mapa = [
            'Esposo' => ['masculino' => 'Esposo', 'feminino' => 'Esposa'],
            'Filho' => ['masculino' => 'Filho', 'feminino' => 'Filha'],
            'Irmão' => ['masculino' => 'Irmão', 'feminino' => 'Irmã'],
            'Neto' => ['masculino' => 'Neto', 'feminino' => 'Neta'],
            'Tio' => ['masculino' => 'Tio', 'feminino' => 'Tia'],
            'Primo' => ['masculino' => 'Primo', 'feminino' => 'Prima'],
            'Genro' => ['masculino' => 'Genro', 'feminino' => 'Nora'],
            'Sogro' => ['masculino' => 'Sogro', 'feminino' => 'Sogra'],
            'Cunhado' => ['masculino' => 'Cunhado', 'feminino' => 'Cunhada'],
            'Padrasto' => ['masculino' => 'Padrasto', 'feminino' => 'Madrasta'],
            'Enteado' => ['masculino' => 'Enteado', 'feminino' => 'Enteada'],
            'Tutor' => ['masculino' => 'Tutor', 'feminino' => 'Tutora'],
            'Vizinho' => ['masculino' => 'Vizinho', 'feminino' => 'Vizinha'],
            'Cuidador' => ['masculino' => 'Cuidador', 'feminino' => 'Cuidadora'],
            'Companheiro' => ['masculino' => 'Companheiro', 'feminino' => 'Companheira'],
            'Amigo' => ['masculino' => 'Amigo', 'feminino' => 'Amiga'],
            'Colega' => ['masculino' => 'Colega', 'feminino' => 'Colega'],
            'Vizinho(a)' => ['masculino' => 'Vizinho', 'feminino' => 'Vizinha'],
            'Amigo(a)' => ['masculino' => 'Amigo', 'feminino' => 'Amiga'],
            'Companheiro(a)' => ['masculino' => 'Companheiro', 'feminino' => 'Companheira'],
            'Cuidador(a)' => ['masculino' => 'Cuidador', 'feminino' => 'Cuidadora'],
            'Tutor(a)' => ['masculino' => 'Tutor', 'feminino' => 'Tutora'],
            'Acompanhante' => ['masculino' => 'Acompanhante', 'feminino' => 'Acompanhante'],
            'Outro' => ['masculino' => 'Outro', 'feminino' => 'Outra'],
            'Pai' => ['masculino' => 'Pai', 'feminino' => 'Mãe'],
            'Avô' => ['masculino' => 'Avô', 'feminino' => 'Avó'],
            'Sobrinho' => ['masculino' => 'Sobrinho', 'feminino' => 'Sobrinha'],
            'Padrinho' => ['masculino' => 'Padrinho', 'feminino' => 'Madrinha']
        ];

        $genero = strtolower($genero ?? '');

        if (isset($mapa[$parentesco]) && isset($mapa[$parentesco][$genero])) {
            return $mapa[$parentesco][$genero];
        }

        return $parentesco;
    }

    public static function obterPronomePosseAcompanhante(?string $genero): string
    {
        return strtolower($genero) === 'feminino' ? 'sua' : 'seu';
    }

    public static function ajustarGenericosEntreParenteses(string $texto, ?string $genero): string
    {
        if (!$genero) return $texto;
        $genero = strtolower($genero);

        $substituicoes = [
            '/\b(acompanhado)\(a\)/i' => $genero === 'feminino' ? 'acompanhada' : 'acompanhado',
            '/\b(visitado)\(a\)/i' => $genero === 'feminino' ? 'visitada' : 'visitado',
            '/\b(orientado)\(a\)/i' => $genero === 'feminino' ? 'orientada' : 'orientado',
            '/\b(seu)\(sua\)/i' => $genero === 'feminino' ? 'sua' : 'seu',
            '/\b(o)\(a\)/i' => $genero === 'feminino' ? 'a' : 'o',
            '/\b(O)\(A\)/i' => $genero === 'feminino' ? 'A' : 'O',
            '/\b(admitido)\(a\)/i' => $genero === 'feminino' ? 'admitida' : 'admitido',
            '/\b(pronto)\(a\)/i' => $genero === 'feminino' ? 'pronta' : 'pronto',
            '/\b(solicitado)\(a\)/i' => $genero === 'feminino' ? 'solicitada' : 'solicitado',
            '/\b(encaminhado)\(a\)/i' => $genero === 'feminino' ? 'encaminhada' : 'encaminhado',
            '/\b(beneficiado)\(a\)/i' => $genero === 'feminino' ? 'beneficiada' : 'beneficiado',
        ];

        foreach ($substituicoes as $pattern => $replacement) {
            $texto = preg_replace($pattern, $replacement, $texto);
        }

        return $texto;
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
