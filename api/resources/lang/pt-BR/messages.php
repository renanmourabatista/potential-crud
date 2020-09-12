<?php

return [
    'developers' => [
        'validation' => [
            'nome_required'               => 'Nome é um campo obrigatório.',
            'sexo_required'               => 'Selecione o sexo.',
            'sexo_in'                     => 'Sexo inválido.',
            'idade_required'              => 'Idade é um campo obrigatório.',
            'idade_numeric'               => 'Idade deve ser um numero.',
            'hobby_required'              => 'Hobby é um campo obrigatório.',
            'data_nascimento_required'    => 'Data de nascimento é um campo obrigatório.',
            'data_nascimento_date_format' => 'Data de nascimento inválida, o formato correto é AAAA-MM-DD.'
        ],
        'remove_success' =>  'Desenvolvedor removido com sucesso.',
        'create_success' =>  'Desenvolvedor adicionado com sucesso.',
        'update_success' =>  'Desenvolvedor atualizado com sucesso.',
    ]
];