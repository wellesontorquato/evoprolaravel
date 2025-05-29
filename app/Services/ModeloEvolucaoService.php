<?php

namespace App\Services;

class ModeloEvolucaoService
{
    protected array $modelosFixos = [
        'acolhimento_social' => "
Realizo acolhimento social junto ao(à) paciente {{paciente}} e seu(sua) acompanhante {{acompanhante}} ({{parentesco}}) no leito, com o objetivo de levantar informações sobre sua realidade social, familiar e econômica, identificando possíveis demandas para intervenção do Serviço Social. No momento da abordagem, o(a) paciente encontrava-se {{estado_paciente}} e relatou ter sido admitido(a) nesta unidade após {{motivo_internacao}}. Reside com {{com_quem_reside}} e a principal fonte de renda familiar é {{fonte_renda}}. Apresenta como rede de apoio {{rede_apoio}}. Durante o acolhimento, foram fornecidas orientações quanto às normas e rotinas institucionais e realizada a entrega da cartilha informativa. Serviço Social seguirá acompanhando e permanece à disposição.
        ",
        'situacao_economica' => "
Foi realizado acolhimento social ao(à) paciente {{paciente}}, acompanhado(a) de {{acompanhante}} ({{parentesco}}), com foco em identificar sua situação socioeconômica e oferecer suporte conforme demandas identificadas. No momento do atendimento, o(a) paciente encontrava-se {{estado_paciente}}, relatando ter sido transferido(a) de {{local_origem}} após {{motivo_internacao}}. Reside com {{com_quem_reside}}, tendo como principal fonte de renda {{fonte_renda}}. Apresenta como rede de apoio {{rede_apoio}}. Durante o atendimento, foram reforçadas as orientações institucionais e entregue a cartilha informativa. O Serviço Social manterá acompanhamento conforme necessidade e evolução clínica.
        ",
        'planejamento_de_intervencoes' => "
Acolhimento social realizado junto ao(à) paciente {{paciente}} para levantamento de dados pessoais e familiares, acompanhado(a) de {{acompanhante}} ({{parentesco}}), com vistas a planejar intervenções adequadas pelo Serviço Social. O(a) paciente foi encontrado(a) {{estado_paciente}}, relatando internação por {{motivo_internacao}}. Reside com {{com_quem_reside}} e apresenta como rede de apoio {{rede_apoio}}. A principal fonte de renda familiar é {{fonte_renda}}. Durante a abordagem, foram esclarecidas dúvidas sobre trâmites hospitalares, reforçadas orientações sobre direitos e realizada a entrega da cartilha informativa institucional. O Serviço Social seguirá acompanhando durante o período de internação.
        ",
    // ✅ Alta hospitalar
        'alta_hospitalar' => "
Paciente {{paciente}} recebeu alta hospitalar em {{data}}, após internação decorrente de {{motivo_internacao}}. Durante o período de acompanhamento, apresentou-se {{estado_paciente}} e contou com apoio de {{rede_apoio}}. Reside com {{com_quem_reside}} e tem como principal fonte de renda {{fonte_renda}}. Foram fornecidas orientações sobre continuidade de cuidados e encaminhamentos. Serviço Social encerra o acompanhamento nesta unidade, mantendo-se à disposição.
    ",

    // ✅ Encaminhamento social
        'encaminhamento_social' => "
Após avaliação social, o(a) paciente {{paciente}} foi encaminhado(a) para {{local_origem}}, considerando a necessidade de acompanhamento pela rede de apoio {{rede_apoio}}. Relata como principal fonte de renda {{fonte_renda}} e reside com {{com_quem_reside}}. Encontra-se {{estado_paciente}} e foi orientado(a) quanto ao serviço de destino, documentação e procedimentos. Serviço Social permanece à disposição.
    ",

    // ✅ Visita domiciliar
        'visita_domiciliar' => "
Realizada visita domiciliar ao(à) paciente {{paciente}} em {{data}}, com objetivo de averiguar condições sociais e ambientais. Foi recepcionado(a) por {{acompanhante}} ({{parentesco}}), que relatou {{estado_paciente}} do(a) paciente. Domicílio compartilhado com {{com_quem_reside}}, apresenta como fonte de renda {{fonte_renda}} e rede de apoio {{rede_apoio}}. Orientações foram prestadas quanto à continuidade do cuidado e garantia de direitos.
    ",

    // ✅ Internação psiquiátrica
        'internacao_psiquiatrica' => "
O(a) paciente {{paciente}} foi admitido(a) em {{local_origem}} após intercorrência de saúde mental relacionada a {{motivo_internacao}}. Durante atendimento, encontrava-se {{estado_paciente}}, acompanhado(a) de {{acompanhante}} ({{parentesco}}). Reside com {{com_quem_reside}} e apresenta como rede de apoio {{rede_apoio}}. Foi orientado(a) quanto aos direitos e acompanhamento pelo CAPS após alta.
    ",

    // ✅ Avaliação socioeconômica
        'avaliacao_socioeconomica' => "
Paciente {{paciente}}, residente com {{com_quem_reside}}, possui como principal fonte de renda {{fonte_renda}}. Encontra-se {{estado_paciente}} e relata como rede de apoio {{rede_apoio}}. Compareceu acompanhado(a) de {{acompanhante}} ({{parentesco}}), sendo acolhido(a) pelo Serviço Social em {{data}}. Avaliação realizada com vistas à elaboração de parecer e apoio institucional.
    ",

    // ✅ Parecer para benefício
        'parecer_beneficio' => "
Considerando os dados levantados no atendimento à(ao) paciente {{paciente}}, que reside com {{com_quem_reside}} e tem como renda principal {{fonte_renda}}, avalia-se a necessidade de encaminhamento para benefício social. O(a) paciente encontra-se {{estado_paciente}} e possui rede de apoio limitada: {{rede_apoio}}. Sendo assim, o Serviço Social recomenda encaminhamento junto ao setor competente, com base na vulnerabilidade observada.
    ",

        'acolhimento_obstetrico' => "
Acolhimento realizado com a usuária {{paciente}}, acompanhada de {{acompanhante}}, {{parentesco}}. Gestação: {{gestacao}}, parto {{tipo_parto}}, com nascimento de RN do sexo {{sexo_rn}}. Reside com {{com_quem_reside}}. Renda familiar proveniente de {{fonte_renda}}. Foram repassadas orientações referentes a direitos sociais, bem como sobre normas e rotinas institucionais. O Serviço Social segue acompanhando a usuária e permanece à disposição.
    ",
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
