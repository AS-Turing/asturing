export interface Tarification {
    formule: string
    inclus: string[]
    prix: string
}

export interface FAQ {
    question: string
    answer: string
}

export interface Service {
    title: string
    description: string
    microServices: string[]
    tarifs: Tarification[]
    faq: FAQ[]
}
