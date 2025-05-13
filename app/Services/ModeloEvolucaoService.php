<?php

namespace App\Services;

class ModeloEvolucaoService
{
    protected array $modelosFixos = [
        'modelo1' => "
Realizo acolhimento social junto ao(à) paciente {{paciente}} e seu(sua) acompanhante {{acompanhante}} ({{parentesco}}) no leito, com o objetivo de levantar informações sobre sua realidade social, familiar e econômica, identificando possíveis demandas para intervenção do Serviço Social. No momento da abordagem, o(a) paciente encontrava-se {{estado_paciente}} e relatou ter sido admitido(a) nesta unidade após {{motivo_internacao}}. Reside com {{com_quem_reside}} e a principal fonte de renda familiar é {{fonte_renda}}. Apresenta como rede de apoio {{rede_apoio}}. Durante o acolhimento, foram fornecidas orientações quanto às normas e rotinas institucionais e realizada a entrega da cartilha informativa. Serviço Social seguirá acompanhando e permanece à disposição.
        ",
        'modelo2' => "
Foi realizado acolhimento social ao(à) paciente {{paciente}}, acompanhado(a) de {{acompanhante}} ({{parentesco}}), com foco em identificar sua situação socioeconômica e oferecer suporte conforme demandas identificadas. No momento do atendimento, o(a) paciente encontrava-se {{estado_paciente}}, relatando ter sido transferido(a) de {{local_origem}} após {{motivo_internacao}}. Reside com {{com_quem_reside}}, tendo como principal fonte de renda {{fonte_renda}}. Apresenta como rede de apoio {{rede_apoio}}. Durante o atendimento, foram reforçadas as orientações institucionais e entregue a cartilha informativa. O Serviço Social manterá acompanhamento conforme necessidade e evolução clínica.
        ",
        'modelo3' => "
Acolhimento social realizado junto ao(à) paciente {{paciente}} para levantamento de dados pessoais e familiares, acompanhado(a) de {{acompanhante}} ({{parentesco}}), com vistas a planejar intervenções adequadas pelo Serviço Social. O(a) paciente foi encontrado(a) {{estado_paciente}}, relatando internação por {{motivo_internacao}}. Reside com {{com_quem_reside}} e apresenta como rede de apoio {{rede_apoio}}. A principal fonte de renda familiar é {{fonte_renda}}. Durante a abordagem, foram esclarecidas dúvidas sobre trâmites hospitalares, reforçadas orientações sobre direitos e realizada a entrega da cartilha informativa institucional. O Serviço Social seguirá acompanhando durante o período de internação.
        "
    ];

    public function getFixos(): array
    {
        return $this->modelosFixos;
    }

    public function gerarConteudo(string $modelo, array $dados): string
    {
        return str_replace(array_keys($dados), array_values($dados), $this->modelosFixos[$modelo] ?? '');
    }
}
