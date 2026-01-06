# Infrastructure DevOps - Gears Projects Motor (GPM)

```                                                                                                                 
┌────────────────────────────────────────────────────────────────────────────────────────────┐┌────────────────────────────────────────────────────────────────────────────────────────────┐                                  
│                           ARCHITECTURE JAMSTACK HEADLESS                                   ││                              FLUX DE DÉPLOIEMENT CONTINU                                   │                              
└────────────────────────────────────────────────────────────────────────────────────────────┘└────────────────────────────────────────────────────────────────────────────────────────────┘                      
                ┌──────────────┐                 ┌──────────────┐                             ┌──────────────┐            ┌──────────────┐            ┌──────────┐         ┌──────────────┐                                   
                │   SANITY     │                 │   SUPABASE   │                             │     CODE     │            │    GITHUB    │            │  CI/CD   │         │   DEPLOY     │                                   
                │   CMS        │ ◄────API────►   │   Backend    │                             │              │ ────1────> │              │ ────2────> │          │ ───3──> │              │                   
                │  Headless    │                 │  PostgreSQL  │                             │  Dev Nuxt    │            │  Versioning  │            │  Build   │         │  Production  │                       
                │  Studio      │                 │  Auth        │                             │  + Sanity    │            │  Code Review │            │  Tests   │         │  Multi-env   │                       
                └──────┬───────┘                 └──────┬───────┘                             └──────────────┘            └──────────────┘            └──────────┘         └──────────────┘                       
                       │                                │                                          Local                   GitHub Actions              Automated            Docker Stack                          
                       │                                │                                     ┌──────────────────────────────────────────────┐   ┌──────────────────────────────────────────┐                 
                       └────────────┬───────────────────┘                                     │        SERVICES EXTERNES INTÉGRÉS            │   │       STACK TECHNIQUE COMPLÈTE           │                         
                                    │                                                         └──────────────────────────────────────────────┘   └──────────────────────────────────────────┘     
                                    ▼                                                         SANITY CMS       SUPABASE       HELLOASSO          Frontend       Backend         DevOps                
                            ┌──────────────┐                                                  ──────────       ────────       ──────────          ────────       ───────         ──────                       
                            │   NUXT 3     │                                                  • Headless       • PostgreSQL   • Paiements         • Nuxt 3       • Sanity        • Docker                     
                            │  Frontend    │                                                  • API temps      • Auth future  • Inscriptions      • Vue.js 3     • Supabase      • Nginx              
                            │   SSR/SSG    │                                                    réel           • BDD temps    • Formations        • SSR/SSG      • PostgreSQL    • Traefik                
                            │  Vue.js 3    │                                                  • Studio web       réel         • Adhésions         • TypeScript   • API REST      • SSL auto       
                            └──────┬───────┘                                                  • Multi-users    • Open source                      • Tailwind     • Real-time     • Backups                    
                                   │                                                          • Versioning     • Scalable                         • Responsive   • Webhooks      • Monitoring         
        ┌──────────────────────────┼──────────────────────────┐                               ┌──────────────────────────────────────────────┐   ┌──────────────────────────────────────────┐        
        │                          │                          │                               │      AVANTAGES DE L'ARCHITECTURE             │   │           WORKFLOW CLIENT                │            
        ▼                          ▼                          ▼                               └──────────────────────────────────────────────┘   └──────────────────────────────────────────┘
┌──────────────┐          ┌──────────────┐          ┌──────────────┐                                                                                                                          
│     DEV      │          │     TEST     │          │     PROD     │                          ✓ Admin Simple vs WordPress                        1. Client modifie contenu sur Sanity Studio      
│  localhost   │          │ dev.gpm.as   │          │   gpm.fr     │                            └─> Interface épurée, focus contenu              2. Webhook déclenche rebuild Nuxt                
│   Docker     │          │   Docker     │          │   Docker     │                                                                             3. Déploiement automatique (5-10 min)              
└──────────────┘          └──────────────┘          └──────────────┘          
                                                                                              ✓ Performance SSG/SSR                              4. Site mis à jour sans intervention                                       
                                                                                                └─> Temps de chargement < 1.5s                   5. Notifications de succès/échec                                                             
                                                                                                                                                                                                                                                       
                                                                                              ✓ Flexibilité éditoriale                          FORMATIONS / ADHÉSIONS                                                                                
                                                                                                └─> Pages modulaires par blocs                   • Client publie via Sanity                                                                                   
                                                                                                                                                 • Liens vers HelloAsso                                                                                                                 
                                                                                              ✓ Scalabilité & Sécurité                          • Paiements externalisés                      
                                                                                                └─> Docker + monitoring + backups                • Pas de gestion comptable                   
                                                                                                                                                 • Simplicité maximale
```