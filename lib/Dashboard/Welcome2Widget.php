<?php
/**
 * @copyright Copyright (c) 2020 Julien Veyssier <eneiluj@posteo.net>
 *
 * @author Julien Veyssier <eneiluj@posteo.net>
 *
 * @license GNU AGPL version 3 or any later version
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 *
 */

namespace OCA\Welcome2\Dashboard;

use OCP\Dashboard\IWidget;
use OCP\IConfig;
use OCP\IL10N;
use OCP\IURLGenerator;
use OCP\Util;

use OCA\Welcome2\AppInfo\Application;

class Welcome2Widget implements IWidget {

	/** @var IL10N */
	private $l10n;
	/**
	 * @var IConfig
	 */
	private $config;
	/**
	 * @var IURLGenerator
	 */
	private $url;

	public function __construct(IL10N $l10n,
								IURLGenerator $url,
								IConfig $config) {
		$this->l10n = $l10n;
		$this->config = $config;
		$this->url = $url;
	}

	/**
	 * @inheritDoc
	 */
	public function getId(): string {
		return 'welcome2';
	}

	/**
	 * @inheritDoc
	 */
	public function getTitle(): string {
		$widgetTitle = $this->config->getAppValue(Application::APP_ID, 'widgetTitle', $this->l10n->t('Welcome2'));
		return $widgetTitle ?: $this->l10n->t('Welcome2');
	}

	/**
	 * @inheritDoc
	 */
	public function getOrder(): int {
		return 10;
	}

	/**
	 * @inheritDoc
	 */
	public function getIconClass(): string {
		return 'icon-welcome2';
	}

	/**
	 * @inheritDoc
	 */
	public function getUrl(): ?string {
		return $this->url->linkToRoute('settings.AdminSettings.index', ['section' => 'theming']);
	}

	/**
	 * @inheritDoc
	 */
	public function load(): void {
		Util::addScript(Application::APP_ID, Application::APP_ID . '-dashboard');
		Util::addStyle(Application::APP_ID, 'dashboard');
	}
}