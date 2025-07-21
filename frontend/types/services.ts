export interface Tarification {
    name: string
    includes: string[]
    price: string
}

export interface FAQ {
    question: string
    answer: string
}

export interface Service {
    slug: string
    title: string
    description: string
    microServices: string[]
    prices: Tarification[]
    faq: FAQ[]
    seo: {
        title: string,
        description: string,
        ogTitle: string,
        ogDescription: string,
        ogUrl: string,
    }
}
