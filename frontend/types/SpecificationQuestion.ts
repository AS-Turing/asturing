export interface SpecificationQuestion {
    id: number
    label: string
    type: string
    placeholder: string
    required: boolean
    pattern: string
    min?: number
    max?: number
    errorMessage: string
    tooltip: string
    displayOrder: number
    typeOptions?: TypeOption[]
    category: Category
}

export interface TypeOption {
    label: string
    value: string
}

export interface Category {
    id: number
    name: string
}
