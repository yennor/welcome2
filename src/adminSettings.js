/* jshint esversion: 6 */

/**
 * Nextcloud - welcome2
 *
 *
 * This file is licensed under the Affero General Public License version 3 or
 * later. See the COPYING file.
 *
 * @author Julien Veyssier <julien-nc@posteo.net>
 * @copyright Julien Veyssier 2021
 */

import { getRequestToken } from '@nextcloud/auth'
import { linkTo } from '@nextcloud/router'
import Vue from 'vue'
import './bootstrap.js'
import AdminSettings from './components/AdminSettings.vue'

__webpack_nonce__ = btoa(getRequestToken()) // eslint-disable-line
__webpack_public_path__ = linkTo('welcome', 'js/') // eslint-disable-line

const View = Vue.extend(AdminSettings)
new View().$mount('#welcome2_prefs')
