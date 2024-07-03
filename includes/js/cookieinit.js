// obtain plugin

import 'https://cdn.jsdelivr.net/gh/orestbida/cookieconsent@3.0.1/dist/cookieconsent.umd.js';

// const analytics = WPVars.analytics
//   ? 'We use analytics.'
//   : 'We do not use analytics.';

// const test = WPVars.media
//   ? {
//       title: 'Media',
//       description:
//         'Embedded content from third-party providers such as YouTube will set cookies once you view them on this website. This content is disabled by default. To view this content, enable the media setting.',
//       linkedCategory: 'media',
//     }
//   : '';

const frame = document.querySelector('iframe');
function disableEmbed() {
  if (frame) {
    const dataSrc = frame.src;

    const videoId = dataSrc.substring(
      dataSrc.indexOf('d/') + 2,
      dataSrc.lastIndexOf('?')
    );

    // console.log(videoId);

    frame.style.backgroundImage = `url(https://i.ytimg.com/vi/${videoId}/hqdefault.jpg)`;
    frame.style.backgroundSize = 'cover';

    frame.setAttribute('data-src', dataSrc);
    frame.src = ``;
  }
}
disableEmbed();

function enableEmbed() {
  if (frame) {
    const dataSrc = frame.getAttribute('data-src');
    frame.src = `${dataSrc}`;
    const btnWrapper = document.querySelector(
      '.wp-block-blockhaus-cookie-consent-wrapper'
    );
    btnWrapper.style.display = 'none';
  }
}
/**
 * All config. options available here:
 * https://cookieconsent.orestbida.com/reference/configuration-reference.html
 */
CookieConsent.run({
  onFirstConsent: ({ cookie }) => {
    console.log('onFirstConsent fired', cookie);

    // onFirstConsent, if analytics category is enabled => enable google analytics as consent should be denied by default

    if (CookieConsent.acceptedCategory('analytics')) {
      console.log('Analytics not consented');
      typeof gtag === 'function' &&
        gtag('consent', 'update', {
          ad_storage: 'granted',
          ad_user_data: 'granted',
          ad_personalization: 'granted',
          analytics_storage: 'granted',
        });
    }
  },
  onConsent: function (cookie) {
    console.log('onConsent fired on every page load!');
  },

  onChange: function (cookie, changed_preferences) {
    console.log('onChange fired!');

    // If analytics category is enabled onChange => enable google analytics.

    if (CookieConsent.acceptedCategory('analytics')) {
      console.log('Analytics not consented');
      typeof gtag === 'function' &&
        gtag('consent', 'update', {
          ad_storage: 'granted',
          ad_user_data: 'granted',
          ad_personalization: 'granted',
          analytics_storage: 'granted',
        });
    }

    // If analytics category is disabled onChange => disable google analytics.

    if (!CookieConsent.acceptedCategory('analytics')) {
      console.log('Analytics not consented');
      typeof gtag === 'function' &&
        gtag('consent', 'update', {
          ad_storage: 'denied',
          ad_user_data: 'denied',
          ad_personalization: 'denied',
          analytics_storage: 'denied',
        });
    }
  },

  categories: {
    necessary: {
      enabled: true, // this category is enabled by default
      readOnly: true, // this category cannot be disabled
    },

    ...(WPVars.media
      ? {
          media: {
            enabled: false,
            services: {
              youtube: {
                label: 'YouTube',
                onAccept: () => {
                  enableEmbed();
                },
                onReject: () => {
                  disableEmbed();
                },
              },
            },
            autoClear: {},
          },
        }
      : {}),
    ...(WPVars.analytics && {
      analytics: {
        enabled: false,
      },
    }),
  },

  language: {
    default: 'en',
    autoDetect: 'document',
    translations: {
      en: {
        consentModal: {
          title: '🍪 We use cookies',
          description: 'Click on "Manage Individual preferences" for details',
          acceptAllBtn: 'Accept all',
          acceptNecessaryBtn: 'Reject all',
          showPreferencesBtn: 'Manage Individual preferences',
        },
        preferencesModal: {
          title: '🍪 Manage cookie preferences',
          acceptAllBtn: 'Accept all',
          acceptNecessaryBtn: 'Reject all',
          savePreferencesBtn: `${
            (WPVars.media || WPVars.analytics) && 'Accept current selection'
          }`,
          closeIconLabel: 'Close modal',
          sections: [
            {
              title: 'Overview',
              description: `<ul><li>This website uses session cookies to manage user logins and comments. No session cookies are set for site visitors who are not logged in or leaving comments.</li> 
              
              ${
                WPVars.media &&
                `<li>To view embedded media content on this site, enable the media setting.</li>`
              } 
              
              ${
                WPVars.analytics
                  ? `<li>This website uses analytics.</li>`
                  : `<li>This website DOES NOT use analytics to track you.</li>`
              }</ul> Manage your preferences below.`,
            },
            {
              title: 'Strictly Necessary cookies',
              description:
                'This website uses session cookies to manage user logins and comments. These cookies are essential for the proper functioning of the website and cannot be disabled.',

              //this field will generate a toggle linked to the 'necessary' category
              linkedCategory: 'necessary',
            },

            ...(WPVars.media && [
              {
                title: 'Media',
                description:
                  'If enabled, embedded media content from third-party provides such as YouTube will set cookies once you view it on this website.',
                linkedCategory: 'media',
              },
            ]),
            ...(WPVars.analytics && [
              {
                title: 'Performance and Analytics',
                description:
                  'These cookies collect information about how you use our website. All of the data is anonymized and cannot be used to identify you.',
                linkedCategory: 'analytics',
              },
            ]),

            {
              title: 'Privacy Policy',
              description:
                'You can view this at our <a href="' +
                WPVars.privacy_page +
                '">Privacy policy page</a>. For any queries in relation to our policy on cookies and your choices, please <a href="' +
                WPVars.contact_page +
                '">contact us</a>',
            },
          ],
        },
      },
    },
  },
});
