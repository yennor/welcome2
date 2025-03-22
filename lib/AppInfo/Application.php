<?php
/**
 * Nextcloud - Welcome2
 *
 *
 * @author Julien Veyssier <julien-nc@posteo.net>
 * @copyright Julien Veyssier 2021
 */

namespace OCA\Welcome2\AppInfo;

use OCA\Welcome2\Dashboard\Welcome2Widget;
use OCA\Welcome2\Listener\CSPListener;
use OCP\AppFramework\App;
use OCP\AppFramework\Bootstrap\IBootContext;
use OCP\AppFramework\Bootstrap\IBootstrap;
use OCP\AppFramework\Bootstrap\IRegistrationContext;
use OCP\IConfig;
use OCP\Security\CSP\AddContentSecurityPolicyEvent;

class Application extends App implements IBootstrap {
	public const APP_ID = 'welcome2';
	private IConfig $config;

	public function __construct(array $urlParams = []) {
		parent::__construct(self::APP_ID, $urlParams);

		$container = $this->getContainer();
		$this->config = $container->get(IConfig::class);
	}

	public function register(IRegistrationContext $context): void {
		$filePath = $this->config->getAppValue(self::APP_ID, 'filePath', '');
		if ($filePath) {
			$context->registerDashboardWidget(Welcome2Widget::class);
			$context->registerEventListener(AddContentSecurityPolicyEvent::class, CSPListener::class);
		}
	}

	public function boot(IBootContext $context): void {
	}
}
