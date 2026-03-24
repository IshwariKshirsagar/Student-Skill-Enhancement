<?php
// Direct enrollment is disabled. All enrollments must go through Razorpay payment.
// See: operations/create_razorpay_order.php and operations/verify_payment.php
http_response_code(403);
echo json_encode(['error' => 'Direct enrollment is not allowed. Payment required.']);
exit;
