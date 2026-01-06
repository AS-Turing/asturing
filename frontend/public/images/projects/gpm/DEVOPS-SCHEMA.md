# Infrastructure DevOps - Gears Projects Motor (GPM)

```
┌────────────────────────────────────────────────────────────────────────────────────────────┐
│                           ARCHITECTURE JAMSTACK HEADLESS                                   │
└────────────────────────────────────────────────────────────────────────────────────────────┘

                ┌──────────────┐                 ┌──────────────┐
                │   SANITY     │                 │   SUPABASE   │
                │   CMS        │ ◄────API────►   │   Backend    │
                │  Headless    │                 │  PostgreSQL  │
                │  Studio      │                 │  Auth        │
                └──────┬───────┘                 └──────┬───────┘
                       │                                │
                       │                                │
                       └────────────┬───────────────────┘
                                    │
                                    ▼
                            ┌──────────────┐
                            │   NUXT 3     │
                            │  Frontend    │
                            │   SSR/SSG    │
                            │  Vue.js 3    │
                            └──────┬───────┘
                                   │
        ┌──────────────────────────┼──────────────────────────┐
        │                          │                          │
        ▼                          ▼                          ▼
┌──────────────┐          ┌──────────────┐          ┌──────────────┐
│     DEV      │          │     TEST     │          │     PROD     │
│  localhost   │          │ dev.gpm.as   │          │   gpm.fr     │
│   Docker     │          │   Docker     │          │   Docker     │
└──────────────┘          └──────────────┘          └──────────────┘

┌────────────────────────────────────────────────────────────────────────────────────────────┐
│                              FLUX DE DÉPLOIEMENT CONTINU                                   │
└────────────────────────────────────────────────────────────────────────────────────────────┘

┌──────────────┐            ┌──────────────┐            ┌──────────┐         ┌──────────────┐
│     CODE     │            │    GITHUB    │            │  CI/CD   │         │   DEPLOY     │
│              │ ────1────> │              │ ────2────> │          │ ───3──> │              │
│  Dev Nuxt    │            │  Versioning  │            │  Build   │         │  Production  │
│  + Sanity    │            │  Code Review │            │  Tests   │         │  Multi-env   │
└──────────────┘            └──────────────┘            └──────────┘         └──────────────┘
     Local                   GitHub Actions              Automated            Docker Stack

┌──────────────────────────────────────────────┐   ┌──────────────────────────────────────────┐
│        SERVICES EXTERNES INTÉGRÉS            │   │       STACK TECHNIQUE COMPLÈTE           │
└──────────────────────────────────────────────┘   └──────────────────────────────────────────┘
                                                    
SANITY CMS       SUPABASE       HELLOASSO          Frontend       Backend         DevOps
──────────       ────────       ──────────          ────────       ───────         ──────
• Headless       • PostgreSQL   • Paiements         • Nuxt 3       • Sanity        • Docker
• API temps      • Auth future  • Inscriptions      • Vue.js 3     • Supabase      • Nginx
  réel           • BDD temps    • Formations        • SSR/SSG      • PostgreSQL    • Traefik
• Studio web       réel         • Adhésions         • TypeScript   • API REST      • SSL auto
• Multi-users    • Open source                      • Tailwind     • Real-time     • Backups
• Versioning     • Scalable                         • Responsive   • Webhooks      • Monitoring

┌──────────────────────────────────────────────┐   ┌──────────────────────────────────────────┐
│      AVANTAGES DE L'ARCHITECTURE             │   │           WORKFLOW CLIENT                │
└──────────────────────────────────────────────┘   └──────────────────────────────────────────┘

✓ Admin Simple vs WordPress                        1. Client modifie contenu sur Sanity Studio
  └─> Interface épurée, focus contenu              2. Webhook déclenche rebuild Nuxt
                                                   3. Déploiement automatique (5-10 min)
✓ Performance SSG/SSR                              4. Site mis à jour sans intervention
  └─> Temps de chargement < 1.5s                   5. Notifications de succès/échec

✓ Flexibilité éditoriale                          FORMATIONS / ADHÉSIONS
  └─> Pages modulaires par blocs                   • Client publie via Sanity
                                                   • Liens vers HelloAsso
✓ Scalabilité & Sécurité                          • Paiements externalisés
  └─> Docker + monitoring + backups                • Pas de gestion comptable
                                                   • Simplicité maximale
```
