export default [
  {
    component: 'CNavItem',
    name: 'Dashboard',
   to: '/admin/dashboard',
    icon: 'cil-speedometer',
    badge: {
      color: 'primary',
      text: 'NEW',
    },
  },
  {
    component: 'CNavTitle',
    name: 'Questions',
  },
  {
    component: 'CNavItem',
    name: 'Questions',
   to: '/admin/questions',
    icon: 'cil-notes',
  },
  {
    component: 'CNavItem',
    name: 'Create question',
   to: '/admin/questions/create',
    icon: 'cil-pencil',
  },
  {
    component: 'CNavTitle',
    name: 'Exams',
  },
  {
    component: 'CNavItem',
    name: 'Exams',
    to: '/exams',
    icon: 'cil-notes',
  },
  {
    component: 'CNavItem',
    name: 'Create exam',
    to: '/exams/create',
    icon: 'cil-pencil',
  },
  {
    component: 'CNavTitle',
    name: 'Theme',
  },
  {
    component: 'CNavItem',
    name: 'Colors',
   to: '/admin/theme/colors',
    icon: 'cil-drop',
  },
  {
    component: 'CNavItem',
    name: 'Typography',
   to: '/admin/theme/typography',
    icon: 'cil-pencil',
  },
  {
    component: 'CNavTitle',
    name: 'Components',
  },
  {
    component: 'CNavGroup',
    name: 'Base',
   to: '/admin/base',
    icon: 'cil-puzzle',
    items: [
      {
        component: 'CNavItem',
        name: 'Accordion',
       to: '/admin/base/accordion',
      },
      {
        component: 'CNavItem',
        name: 'Breadcrumbs',
       to: '/admin/base/breadcrumbs',
      },
      {
        component: 'CNavItem',
        name: 'Cards',
       to: '/admin/base/cards',
      },
      {
        component: 'CNavItem',
        name: 'Carousels',
       to: '/admin/base/carousels',
      },
      {
        component: 'CNavItem',
        name: 'Collapses',
       to: '/admin/base/collapses',
      },
      {
        component: 'CNavItem',
        name: 'List Groups',
       to: '/admin/base/list-groups',
      },
      {
        component: 'CNavItem',
        name: 'Navs & Tabs',
       to: '/admin/base/navs',
      },
      {
        component: 'CNavItem',
        name: 'Paginations',
       to: '/admin/base/paginations',
      },
      {
        component: 'CNavItem',
        name: 'Placeholders',
       to: '/admin/base/placeholders',
      },
      {
        component: 'CNavItem',
        name: 'Popovers',
       to: '/admin/base/popovers',
      },
      {
        component: 'CNavItem',
        name: 'Progress',
       to: '/admin/base/progress',
      },
      {
        component: 'CNavItem',
        name: 'Spinners',
       to: '/admin/base/spinners',
      },
      {
        component: 'CNavItem',
        name: 'Tables',
       to: '/admin/base/tables',
      },
      {
        component: 'CNavItem',
        name: 'Tooltips',
       to: '/admin/base/tooltips',
      },
    ],
  },
  {
    component: 'CNavGroup',
    name: 'Buttons',
   to: '/admin/buttons',
    icon: 'cil-cursor',
    items: [
      {
        component: 'CNavItem',
        name: 'Buttons',
       to: '/admin/buttons/standard-buttons',
      },
      {
        component: 'CNavItem',
        name: 'Button Groups',
       to: '/admin/buttons/button-groups',
      },
      {
        component: 'CNavItem',
        name: 'Dropdowns',
       to: '/admin/buttons/dropdowns',
      },
    ],
  },
  {
    component: 'CNavGroup',
    name: 'Forms',
   to: '/admin/forms',
    icon: 'cil-notes',
    items: [
      {
        component: 'CNavItem',
        name: 'Form Control',
       to: '/admin/forms/form-control',
      },
      {
        component: 'CNavItem',
        name: 'Select',
       to: '/admin/forms/select',
      },
      {
        component: 'CNavItem',
        name: 'Checks & Radios',
       to: '/admin/forms/checks-radios',
      },
      {
        component: 'CNavItem',
        name: 'Range',
       to: '/admin/forms/range',
      },
      {
        component: 'CNavItem',
        name: 'Input Group',
       to: '/admin/forms/input-group',
      },
      {
        component: 'CNavItem',
        name: 'Floating Labels',
       to: '/admin/forms/floating-labels',
      },
      {
        component: 'CNavItem',
        name: 'Layout',
       to: '/admin/forms/layout',
      },
      {
        component: 'CNavItem',
        name: 'Validation',
       to: '/admin/forms/validation',
      },
    ],
  },
  {
    component: 'CNavItem',
    name: 'Charts',
   to: '/admin/charts',
    icon: 'cil-chart-pie',
  },
  {
    component: 'CNavGroup',
    name: 'Icons',
   to: '/admin/icons',
    icon: 'cil-star',
    items: [
      {
        component: 'CNavItem',
        name: 'CoreUI Icons',
       to: '/admin/icons/coreui-icons',
        badge: {
          color: 'info',
          text: 'NEW',
        },
      },
      {
        component: 'CNavItem',
        name: 'Brands',
       to: '/admin/icons/brands',
      },
      {
        component: 'CNavItem',
        name: 'Flags',
       to: '/admin/icons/flags',
      },
    ],
  },
  {
    component: 'CNavGroup',
    name: 'Notifications',
   to: '/admin/notifications',
    icon: 'cil-bell',
    items: [
      {
        component: 'CNavItem',
        name: 'Alerts',
       to: '/admin/notifications/alerts',
      },
      {
        component: 'CNavItem',
        name: 'Badges',
       to: '/admin/notifications/badges',
      },
      {
        component: 'CNavItem',
        name: 'Modals',
       to: '/admin/notifications/modals',
      },
    ],
  },
  {
    component: 'CNavItem',
    name: 'Widgets',
   to: '/admin/widgets',
    icon: 'cil-calculator',
    badge: {
      color: 'primary',
      text: 'NEW',
      shape: 'pill',
    },
  },
  {
    component: 'CNavTitle',
    name: 'Extras',
  },
  {
    component: 'CNavGroup',
    name: 'Pages',
    to: '/pages',
    icon: 'cil-star',
    items: [
      {
        component: 'CNavItem',
        name: 'Login',
        to: '/pages/login',
      },
      {
        component: 'CNavItem',
        name: 'Register',
        to: '/pages/register',
      },
      {
        component: 'CNavItem',
        name: 'Error 404',
        to: '/pages/404',
      },
      {
        component: 'CNavItem',
        name: 'Error 500',
        to: '/pages/500',
      },
    ],
  },

  // {
  //   component: 'CNavItem',
  //   name: 'Download CoreUI',
  //   href: 'http://coreui.io/vue/',
  //   icon: { name: 'cil-cloud-download', class: 'text-white' },
  //   _class: 'bg-success text-white',
  //   target: '_blank'
  // },
  // {
  //   component: 'CNavItem',
  //   name: 'Try CoreUI PRO',
  //   href: 'http://coreui.io/pro/vue/',
  //   icon: { name: 'cil-layers', class: 'text-white' },
  //   _class: 'bg-danger text-white',
  //   target: '_blank'
  // }
]
