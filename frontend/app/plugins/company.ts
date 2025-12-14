export default defineNuxtPlugin(async () => {
  const { fetchCompanyInfo } = useCompany()
  
  await fetchCompanyInfo()
})
