var dictionary = {
    "pt": {
        "THING": "COISA",
        "Checking the axioms, please wait...": "Checando os axiomas, aguarde um momento...",
        "The axioms are valid!": "Os axiomas são válidos!",
        "The axioms are not valid!": "Os axioma não são válidos!",
        "None axiom to check!": "Nenhum axioma para checar!",
        "The datatype property": "O tipo de dado",
        "it is not connected to a class": "não está conectada a uma classe",
        "Basic Error": "Erro Basico",
        "The relation": "A relação",
        "it is not fully connected to 2 classes": "não está conectada a duas classes",
        "You cant have a instance_of relation between two classes": "Você não pode ter uma relação instancia_um entre duas classes",
        "It must be between one class and one instance.": "A relação precisa estar entre uma classe e uma instância.",
        "Conceptual Error": "Erro Conceitual",
        "In the": "Na relação",
        "Relation, you did not fill the following properties:": "você não preencheu as seguintes propriedades:",
        "Bad Practice": "Má Prática",
        "You can not have two classes with the same name, you have two classes named": "Você não pode ter duas classes com o mesmo nome, você tem duas classes chamadas",
        "Conceptual Error": "Erro Conceitual",
        "You can't have 2 equal relations pointing to the same classes. This error occurs in the following classes:": "Você não pode ter duas relações iguais apontando para as mesmas classes. Esse erro ocorre nas seguintes classes:",
        "and": "e",
        "A class can't have multiple inheritance. Your": "Classes não podem ter herança múltipla. Sua classe",
        "class can't be the domain of more than one is_a relation": "não pode ser o domínio de mais de uma relação is_a",
        "It is recommended that the labels do not have acronyms": "É recomendável que os nomes não tenham acrônimos.",
        "All changes saved": "Todas as alterações foram salvas",
        "Unsaved changes. Click here to save": "Alterações não salvas. Clique aqui para salvar",
        "An error occurred saving changes": "Ocorreu um erro ao salvar as alterações",
        "You dont have any warnings.": "Voce não tem nenhum aviso",
        "It is necessary that every ontology has a class called Thing. Add a Thing class to your ontology.": "É necessário que toda ontologia tenha uma classe chamada Coisa. Adicione uma classe Coisa a sua ontologia.",
        "Unable to send the message, please try again later.": "Não foi possivel enviar a mensagem, tente novamente mais tarde.",
        "Dear user, the format of the ontology to be imported is not compatible with Onto4AllEditor. This version of the editor accepts imports in the following formats: OWL / XML, .XML": "Prezado usuário, o formato da ontologia a ser importada não é compatível com o Onto4AllEditor. Essa versão do editor aceita importações nos seguintes formatos: OWL/XML, .XML",
        "None axiom to check!": "Nenhum axioma para checar",
        "Checking the axioms, please wait...": "Checando os axiomas, aguarde um momento...",
        "(The property name must be only numbers and letters)": "'(O nome da propriedade pode conter apenas letras e números)",
        "Select one relation": "Selecione uma relação",
        "Select one or more relations": "Selecione uma ou mais relações",
        "Select one or more classes": "Selecione uma ou mais classes",
        "Label": "Label",
        "is_a": "é_um",
        "Taxonomy": "Taxonomia",
        "Basic Ontology": "Ontologia Básica",
        "new_relation": "nova_relação",
        "Instance": "Instância",
        "new_datatype_property": "new_datatype_property",
        "BFO Ontology": "Ontologia BFO",
        "Continuant": "Continuante",
        "Independent Continuant": "Continuante independente",
        "Generically Dependent Continuant": "Continuante Genericamente Dependente",
        "Specifically Dependent Continuant": "Continuante Especificamente Dependente",
        "Material Entity": "Entidade Material",
        "Immaterial Entity": "Entidade Imaterial",
        "Quality": "Qualidade",
        "Realizable Entity": "Entidade Realizável",
        "Object": "Objeto",
        "Fiat Object Part": "Parte Fiat de Objeto",
        "Object Aggregate": "Objeto Agregado",
        "Site": "Local",
        "Continuant Fiat Boundary": "Limite Fiat Continuante",
        "Spatial Region": "Região espacial",
        "Relational Quality": "Qualidade Relacional",
        "Role": "Papel",
        "Disposition": "Disposição",
        "Zero-dimensional Continuant Fiat Boundary": "Limite Fiat de Continuante 0-D",
        "One-dimensional Continuant Fiat Boundary": "Limite Fiat de Continuante 1-D",
        "Two-dimensional Continuant Fiat Boundary": "Limite Fiat de Continuante 2-D",
        "Zero-dimensional Spatial Region": "Região espacial 0-D",
        "One-dimensional Spatial Region": "Região espacial 1-D",
        "Two-dimensional Spatial Region": "Região espacial 2-D",
        "Three-dimensional Spatial Region": "Região espacial 3-D",
        "Occurrent": "Ocorrente",
        "Process": "Processo",
        "Process Boundary": "Limite de processo",
        "Temporal Region": "Região temporal",
        "Spatiotemporal Region": "Região espaço-temporal",
        "Process Profile": "Perfil de processo",
        "Zero-dimensional Temporal Region": "Região temporal 0-D",
        "One-dimensional Temporal Region": "Região temporal 1-D",
        "instance_of": "instancia_um",
        "inheres_in": "Inerente_a",
        "bearer_of": "Portador_de",
        "specifically_depend": "e_depende_de",
        "generically_depend": "g_depende_de",
        "quality_of": "Qualidade_de",
        "participates_in": "Participa_de",
        "exists_at": "Existe_em",
        "part_of": "Parte_de",
        "concretizes": "Concretiza_em",
        "projects_onto": "Projeta_sobre",
        "occupies": "Ocupa",
        "located_in": "Localizado_em",
        "occurs_in": "Ocorre_em",
        "realizes": "Realiza",
        "projects_into": "q_projeta_em",
        "role_of": "é_papel_de",
        "disposition_of": "é_disposição_de",
        "function_of": "é_função_de",
        "There was an error importing the ontology, please try again later.": "Ocorreu um erro ao importar a ontologia, tente novamente mais tarde."
    }
};

/**
 * Get the language by looking at the pathname
 * @returns {string}
 */
 function getLanguage() {
    return window.location.pathname.split("/")[1];
}

/**
 * Get the translation by key
 * @returns {string}
 */
function getTranslation(key) {
    if (getLanguage() === 'pt') {
        return dictionary['pt'][key];
    } else {
        return key;
    }
}