
	/**
	 * Conversor de divisas basado en parámetros URL
	 * Detecta automáticamente la moneda desde ?currency=XXX en la URL
	 */
	jQuery(document).ready(function($) {

		// Configuración
		const baseCurrency = 'COP';
		const supportedCurrencies = ['COP', 'USD', 'EUR'];
		const apiUrl = 'https://open.er-api.com/v6/latest/' + baseCurrency;

		// Selector para los elementos de precio
		const priceSelector = '.precio';

		// Almacenamiento en caché para las tasas de cambio (válido por 24 horas)
		const storageKey = 'exchange_rates_data';
		const cacheExpiry = 24 * 60 * 60 * 1000; // 24 horas en milisegundos

		/**
		 * Obtener parámetro de la URL
		 */
		function getUrlParameter(name) {
			name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
			const regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
			const results = regex.exec(location.search);
			return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
		}

		/**
		 * Obtener la moneda actual desde la URL o usar la predeterminada
		 */
		function getCurrentCurrency() {
			const urlCurrency = getUrlParameter('currency');
			// Verificar si es una moneda soportada
			if (supportedCurrencies.includes(urlCurrency)) {
				return urlCurrency;
			}
			return baseCurrency; // Valor predeterminado
		}

		/**
		 * Obtener tasas de cambio (desde caché o API)
		 */
		async function getExchangeRates() {
			// Intentar recuperar desde localStorage
			const cachedData = localStorage.getItem(storageKey);

			if (cachedData) {
				const data = JSON.parse(cachedData);
				// Verificar si los datos son recientes (menos de 24 horas)
				if (data.timestamp && (new Date().getTime() - data.timestamp < cacheExpiry)) {
					return data.rates;
				}
			}

			// Si no hay caché válida, consultar la API
			try {
				const response = await fetch(apiUrl);
				const data = await response.json();

				if (data.rates) {
					// Agregar la tasa para COP (que es 1 por definición)
					data.rates.COP = 1;

					// Guardar en localStorage con timestamp
					const cacheData = {
						timestamp: new Date().getTime(),
						rates: data.rates
					};
					localStorage.setItem(storageKey, JSON.stringify(cacheData));
					return data.rates;
				}
			} catch (error) {
				console.error('Error al obtener tasas de cambio:', error);
				// Usar tasas de respaldo si falla la API
				return {
					'COP': 1,
					'USD': 0.00025,
					'EUR': 0.00023
				};
			}
		}

		/**
		 * Formatear precio según la moneda
		 */
		function formatPrice(price, currency) {
			// Redondear a entero para eliminar decimales
			price = Math.round(price);

			switch (currency) {
				case 'COP':
					return price.toLocaleString('es-CO').replace(/,/g, '.');
				case 'USD':
					// Sin decimales, solo separador de miles
					return price.toLocaleString('en-US', {
						maximumFractionDigits: 0
					});
				case 'EUR':
					// Sin decimales, separador de miles europeo
					return price.toLocaleString('de-DE', {
						maximumFractionDigits: 0
					});
				default:
					return price.toLocaleString();
			}
		}

		/**
		 * Actualizar símbolo de moneda
		 */
		// Add this to your updateCurrencySymbol function
		function updateCurrencySymbol(currency) {
			$('.simbolo').each(function() {
				switch (currency) {
					case 'COP':
						$(this).text('$');
						break;
					case 'USD':
						$(this).text('US$');
						break;
					case 'EUR':
						$(this).text('€');
						break;
				}
			});

			// Add this part to update the currency name
			$('.moneda').each(function() {
				$(this).text(currency);
			});
		}

		/**
		 * Convertir todos los precios a la moneda actual
		 */
		async function initCurrencyConverter() {
			// Obtener moneda actual desde URL
			const currentCurrency = getCurrentCurrency();

			// Si es la moneda base, no necesitamos hacer nada más
			if (currentCurrency === baseCurrency) {
				return;
			}

			// Obtener tasas de cambio
			const rates = await getExchangeRates();

			// Asegurarnos de que tenemos la tasa correcta
			if (!rates[currentCurrency]) {
				console.error('Tasa de cambio no disponible para', currentCurrency);
				return;
			}

			// Actualizar todos los precios
			$(priceSelector).each(function() {
				// Obtener el precio original en COP (del atributo data-precio)
				const originalPrice = parseFloat($(this).attr('data-precio'));

				if (!isNaN(originalPrice)) {
					// Convertir a la moneda seleccionada
					const newPrice = originalPrice * rates[currentCurrency];

					// Actualizar el texto o valor según el tipo de elemento
					if (this.tagName.toLowerCase() === 'input') {
						$(this).val(formatPrice(newPrice, currentCurrency));
					} else {
						$(this).text(formatPrice(newPrice, currentCurrency));
					}
				}
			});

			// Actualizar símbolos de moneda
			updateCurrencySymbol(currentCurrency);

			// Resaltar la moneda seleccionada en el menú
			$('#currency .dropdown-item').each(function() {
				const href = $(this).attr('href');
				if (href && href.includes('currency=' + currentCurrency)) {
					$(this).addClass('active');
				}
			});
		}

		// Inicializar conversor de moneda
		$(function() {
			initCurrencyConverter();
		});
	});

	/**
	 * Reemplazar "DIVISA" con la moneda seleccionada
	 */
	jQuery(document).ready(function($) {
		// Función para obtener parámetro de URL
		function getUrlParameter(name) {
			name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
			const regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
			const results = regex.exec(location.search);
			return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
		}

		// Obtener la moneda actual
		const currentCurrency = getUrlParameter('currency') || 'COP';

		// Textos de las monedas para mostrar
		const currencyLabels = {
			'COP': '$ COP',
			'USD': '$ USD',
			'EUR': '€ EUR'
		};

		// Buscar el botón dropdown que contiene "DIVISA" y reemplazarlo
		$('.dropdown-toggle').each(function() {
			const buttonText = $(this).text().trim();
			if (buttonText === 'Divisa') {
				$(this).text(currencyLabels[currentCurrency] || buttonText);
			}
		});

		// También marcar como active la opción del menú correspondiente
		$('#currency .dropdown-item').each(function() {
			const href = $(this).attr('href');
			if (href && href.includes('currency=' + currentCurrency)) {
				$(this).addClass('active');
			}
		});
	});
