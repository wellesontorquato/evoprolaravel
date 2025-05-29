<optgroup label="📌 Modelos Fixos">
    <option value="acolhimento_social" {{ request('modelo_fixo') == 'acolhimento_social' ? 'selected' : '' }}>
        Acolhimento Social e Mapeamento
    </option> 
    <option value="situacao_economica" {{ request('modelo_fixo') == 'situacao_economica' ? 'selected' : '' }}>
        Situação Socioeconômica
    </option> 
    <option value="planejamento_de_intervencoes" {{ request('modelo_fixo') == 'planejamento_de_intervencoes' ? 'selected' : '' }}>
        Planejamento de Intervenções
    </option> 
    <option value="alta_hospitalar" {{ request('modelo_fixo') == 'alta_hospitalar' ? 'selected' : '' }}>
        Alta Hospitalar
    </option> 
    <option value="encaminhamento_social" {{ request('modelo_fixo') == 'encaminhamento_social' ? 'selected' : '' }}>
        Encaminhamento Social
    </option> 
    <option value="visita_domiciliar" {{ request('modelo_fixo') == 'visita_domiciliar' ? 'selected' : '' }}>
        Visita Domiciliar
    </option> 
    <option value="internacao_psiquiatrica" {{ request('modelo_fixo') == 'internacao_psiquiatrica' ? 'selected' : '' }}>
        Evolução para Internação Psiquiátrica
    </option> 
    <option value="avaliacao_socioeconomica" {{ request('modelo_fixo') == 'avaliacao_socioeconomica' ? 'selected' : '' }}>
        Avaliação Socioeconômica
    </option> 
    <option value="parecer_beneficio" {{ request('modelo_fixo') == 'parecer_beneficio' ? 'selected' : '' }}>
        Parecer para Concessão de Benefício
    </option>
    <option value="acolhimento_obstetrico" {{ request('modelo_fixo') == 'acolhimento_obstetrico' ? 'selected' : '' }}>
        Acolhimento Obstétrico e Orientações Sociais
    </option> 
</optgroup>
