export interface Service {
    id: number
    slug: string
    title: string
    description: string
    microServices: string[]
    prices: Price[]
    faqs: Faq[]
    seo: Seo
}

export interface Price {
    id: number
    name: string
    includes: string[]
    price: string
    service: number
}

export interface Faq {
    id: number
    question: string
    answer: string
    service: number
}

export interface Seo {
    id: number
    title: string
    description: string
    ogTitle: string
    ogDescription: string
    ogUrl: string
    service: number
}