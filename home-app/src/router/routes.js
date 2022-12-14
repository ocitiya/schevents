
const routes = [
  {
    path: '/',
    component: () => import('layouts/MainLayout.vue'),
    children: [
      { path: '', name: 'home', component: () => import('pages/HomePage.vue') },
      { path: 'schedule', name: 'schedule', children: [
       { path: 'team', name: 'schedule-team', component: () => import('pages/ScheduleTeamPage.vue') } ,
       { path: 'athlete', name: 'schedule-athlete', component: () => import('pages/ScheduleAthletePage.vue') } ,
      ]},
      { path: 'club', name: 'club', component: () => import('pages/ClubPage.vue') },
      { path: 'athlete', name: 'athlete', component: () => import('pages/AthletePage.vue') },
      { path: 'about', name: 'about', component: () => import('pages/AboutPage.vue') },
      { path: 'scores', name: 'scores', component: () => import('pages/ScorePage.vue') },
      { path: 'news', name: 'news', component: () => import('pages/NewsPage.vue') },
      { path: 'news/:id', name: 'news.detail', component: () => import('pages/NewsDetailPage.vue') },
      { path: 'video', name: 'video', component: () => import('pages/VideoPage.vue') },
      { path: 'privacy-policy', name: 'privacy-policy', component: () => import('pages/PrivacyPolicyPage.vue') },
      { path: 'terms-of-use', name: 'terms-of-use', component: () => import('src/pages/TermsOfUsePage.vue') },
      { path: 'ways-to-watch', name: 'ways-to-watch', component: () => import('src/pages/WaysToWatchPage.vue') },
      { path: 'help-support', name: 'help-support', component: () => import('src/pages/HelpSupportPage.vue') },
      { path: 'contact', name: 'contact', component: () => import('src/pages/ContactPage.vue') },

      // sub app
      { path: 'event', name: 'event', component: () => import('pages/EventPage.vue') },
      { path: 'movie', name: 'movie', component: () => import('pages/MoviePage.vue') }
    ]
  },

  // Always leave this as last one,
  // but you can also remove it
  {
    path: '/:catchAll(.*)*',
    component: () => import('pages/ErrorNotFound.vue')
  }
]

export default routes
