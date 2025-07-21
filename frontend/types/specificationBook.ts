export interface SpecificationBook {
    id: number
    description: string
    createdAt: string
    client: Client
    file: File[]
}

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
    specificationBooks: number[]
}

export interface File {
    id: number
    filename: string
    uploadedAt: string
    specificationBook: number
    quote: any
    fileUrl: string
}
