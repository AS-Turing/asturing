import type { CompanyInfo } from '~/types/company'

export const useCompany = () => {
  const companyInfo = useState<CompanyInfo | null>('companyInfo', () => null)

  const fetchCompanyInfo = async (): Promise<CompanyInfo | null> => {
    try {
      const response = await $fetch<CompanyInfo>('/api/company/info')
      companyInfo.value = response
      return response
    } catch (error) {
      console.error('Error fetching company info:', error)
      return null
    }
  }

  return {
    companyInfo: readonly(companyInfo),
    fetchCompanyInfo
  }
}
