import { SpecificationBook } from './specificationBook'

export interface Client {
    id: number
    email: string
    firstname: string
    lastname: string
    phone: string
    company: string
    tvaNumber: string
    siret: string
    codeNaf: string
    address: string
    zipCode: string
    country: string
    webSite: string
    quotes: any[]
    specificationBooks: SpecificationBook[]
}