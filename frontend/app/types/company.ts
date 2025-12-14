export interface CompanyInfo {
  id: number
  companyName: string
  tagline?: string
  description?: string
  phone?: string
  email: string
  address?: string
  city?: string
  zipCode?: string
  region?: string
  country?: string
  socialNetworks?: {
    github?: string
    linkedin?: string
    twitter?: string
    facebook?: string
    instagram?: string
  }
  logoPath?: string
  siret?: string
  tva?: string
  businessHours?: {
    monday?: { open: string; close: string } | null
    tuesday?: { open: string; close: string } | null
    wednesday?: { open: string; close: string } | null
    thursday?: { open: string; close: string } | null
    friday?: { open: string; close: string } | null
    saturday?: { open: string; close: string } | null
    sunday?: { open: string; close: string } | null
  }
}
