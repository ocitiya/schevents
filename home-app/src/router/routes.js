
const routes = [
  {
    path: '/',
    component: () => import('layouts/MainLayout.vue'),
    children: [
      { path: '', name: 'home', component: () => import('pages/HomePage.vue') },
      { path: 'schedule', name: 'schedule', component: () => import('pages/SchedulePage.vue') },
      { path: 'club', name: 'club', component: () => import('pages/ClubPage.vue') },
      { path: 'about', name: 'about', component: () => import('pages/AboutPage.vue') },
      { path: 'scores', name: 'scores', component: () => import('pages/ScorePage.vue') },
      { path: 'news', name: 'news', component: () => import('pages/NewsPage.vue') },
      { path: 'news/:id', name: 'news.detail', component: () => import('pages/NewsDetailPage.vue') },
      { path: 'video', name: 'video', component: () => import('pages/VideoPage.vue') },
      { path: 'privacy-policy', name: 'privacy-policy', component: () => import('pages/PrivacyPolicyPage.vue') },
      { path: 'video', name: 'video', component: () => import('pages/VideoPage.vue') },

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
