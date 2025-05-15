<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link href="https://fonts.googleapis.com/css?family=Lexend&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/basket.css">
</head>
<body>
    <div class="shopping-container">
        <div class="shopping-items">
            <h1 class="section-title"><img src="..\resources\arrow.svg" alt="arrow"> Shopping Continue</h1>
            <div class="shopping-list">
                <h2 class="section-title" style="margin-top: 25px; margin-bottom: 40px;">Shopping Item</h2>
                <div class="cart-item">
                    <div class="item-image"><img src="..\resources\vermicelli.svg" alt="vermicelli"></div>
                    <div class="item-details">
                        <div class="item-name">Vermicelli Upma</div>
                        <div class="item-quantity">
                            <button class="quantity-btn">-</button>
                            <span class="quantity-number">00</span>
                            <button class="quantity-btn">+</button>
                        </div>
                    </div>
                    <div class="item-price">₹200</div>
                    <button class="remove-btn"><img src="..\resources\delete_logo.svg" alt="delete"></button>
                </div>
                
                <div class="cart-item">
                    <div class="item-image"><img src="..\resources\vermicelli.svg" alt="vermicelli"></div>
                    <div class="item-details">
                        <div class="item-name">Vermicelli Upma</div>
                        <div class="item-quantity">
                            <button class="quantity-btn">-</button>
                            <span class="quantity-number">00</span>
                            <button class="quantity-btn">+</button>
                        </div>
                    </div>
                    <div class="item-price">₹200</div>
                    <button class="remove-btn"><img src="..\resources\delete_logo.svg" alt="delete"></button>
                </div>
                
                <div class="cart-item">
                    <div class="item-image"><img src="..\resources\vermicelli.svg" alt="vermicelli"></div>
                    <div class="item-details">
                        <div class="item-name">Vermicelli Upma</div>
                        <div class="item-quantity">
                            <button class="quantity-btn">-</button>
                            <span class="quantity-number">00</span>
                            <button class="quantity-btn">+</button>
                        </div>
                    </div>
                    <div class="item-price">₹200</div>
                    <button class="remove-btn"><img src="..\resources\delete_logo.svg" alt="delete"></button>
                </div>
                
                <div class="cart-item">
                    <div class="item-image"><img src="..\resources\vermicelli.svg" alt="vermicelli"></div>
                    <div class="item-details">
                        <div class="item-name">Vermicelli Upma</div>
                        <div class="item-quantity">
                            <button class="quantity-btn">-</button>
                            <span class="quantity-number">00</span>
                            <button class="quantity-btn">+</button>
                        </div>
                    </div>
                    <div class="item-price">₹200</div>
                    <button class="remove-btn"><img src="..\resources\delete_logo.svg" alt="delete"></button>
                </div>
            </div>
        </div>
        
        <div class="payment-section">
            <h2 class="payment-title">Card Details</h2>
            
            <div class="payment-form">
                <div class="form-group">
                    <label class="form-label">Name on card</label>
                    <input type="text" class="form-input" placeholder="Name">
                </div>
                
                <div class="form-group">
                    <label class="form-label">Card Number</label>
                    <input type="text" class="form-input" placeholder="1111 2222 3333 4444">
                </div>
                
                <div class="form-group split-inputs">
                    <div class="split-input">
                        <label class="form-label">Expiration date</label>
                        <input type="text" class="form-input" placeholder="mm/yy">
                    </div>
                    <div class="split-input">
                        <label class="form-label">CVV</label>
                        <input type="text" class="form-input" placeholder="123">
                    </div>
                </div>
            </div>
            
            <div class="order-summary">
                <div class="summary-row">
                    <span>Subtotal</span>
                    <span>$1,668</span>
                </div>
                <div class="summary-row">
                    <span>Shipping (Free Delivery)</span>
                    <span>$0</span>
                </div>
                <div class="summary-row total-row">
                    <span>Total (Tax incl.)</span>
                    <span>$1,672</span>
                </div>
            </div>
            
            <button class="checkout-btn">Checkout</button>
        </div>
    </div>
</body>
</html>