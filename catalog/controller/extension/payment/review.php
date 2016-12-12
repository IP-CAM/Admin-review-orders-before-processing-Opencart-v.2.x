<?php
class ControllerExtensionPaymentReview extends Controller {
	public function index() {
		$this->load->language('extension/payment/review');

		$data['text_instruction'] = $this->language->get('text_instruction');
		$data['text_note'] = $this->language->get('text_note');
		$data['text_payment'] = $this->language->get('text_payment');
		$data['text_loading'] = $this->language->get('text_loading');

		$data['button_confirm'] = $this->language->get('button_confirm');

		$data['address'] = nl2br($this->config->get('config_address'));

		$data['continue'] = $this->url->link('checkout/success');

		return $this->load->view('extension/payment/review', $data);
	}

	public function confirm() {
		if ($this->session->data['payment_method']['code'] == 'review') {
			$this->load->language('extension/payment/review');

			$this->load->model('checkout/order');

			$comment .= $this->language->get('text_note') . "\n";
			$comment .= $this->language->get('text_payment') . "\n";

			$this->model_checkout_order->addOrderHistory($this->session->data['order_id'], $this->config->get('review_order_status_id'), $comment, true);
		}
	}
}