<!-- File: src/Template/Articles/add.ctp -->
 <div class="row" id="logo">
        <h1>Conestoga Pizzeria</h1>
		<marquee><h2 style="color:#fff;s">Order Now to get 20% OFF</h2></marquee>
    </div>
	
	<div class="container-fluid">        
		<div class="row">
    <? echo $this->Form->create($order, array('id' => 'pizzaForm')); ?>
    <div id="personalDetails" class="col-md-6">
    <?
        echo $this->Form->input('name');
        echo $this->Form->input('email');
        echo $this->Form->input('phoneNumber');
        echo $this->Form->input('address');
        echo $this->Form->input('city', array('options' => array('kitchener' => 'Kitchener', 'waterloo' => 'Waterloo', 'cambridge' => 'Cambridge', 'oronto' => 'Toronto')));
        echo $this->Form->input('province', array('options' => array('ontario' => 'Ontario', 'quebec' => 'Quebec', 'saskatchewan' => 'Saskatchewan', 'alberta' => 'Alberta')));
        echo $this->Form->input('postalCode');
    ?>
    </div>
    <div id="pizzaDetails" class="col-md-6">
        <?php
        echo $this->Form->input('size', array('options' => array('small' => 'Small', 'medium' => 'Medium', 'large' => 'Large', 'extraLarge' => 'Extra Large')));
        echo $this->Form->input('crust', array('options' => array('handTossed' => 'Hand Tossed', 'pan' => 'Pan', 'stuffed' => 'Stuffed', 'thin' => 'Thin')));
?>
        <div style="margin-bottom:20px;" class="col-sm-6">
            <?php
                echo $this->Form->input('toppings1', array(
                    'label' => 'Toppings',
                    'type' => 'select',
                    'multiple' => 'checkbox',
                    'options' => array('Pepperoni '=>'Pepperoni','Sausage'=>'Sausage','Meatballs'=>'Meatballs','Ham'=>'Ham'),
                  )); 
            ?>
        </div>
        <div style="margin-bottom:20px;" class="col-sm-6">
            <?php
                echo $this->Form->input('toppings2', array(
                    'label' => 'Toppings',
                    'type' => 'select',
                    'multiple' => 'checkbox',
                    'options' => array('Mushrooms '=>'Mushrooms','Extra Cheese'=>'Extra Cheese','Corn'=>'Corn','Pineapple'=>'Pineapple'),
                  ));    
            ?>
        </div>
    </div>
    <div class="submitButton">
<!--        <input type="hidden" id="bill" name="Final Bill" value="0"/>-->
        <?php
        echo $this->Form->button(__('Order Now'), array('class'=>'order_btn'));
        echo $this->Form->end();
        ?>
    </div>
    <div class="submitButton">
        <?= $this->Html->link('Staff Login', ['action' => 'login']) ?>
    </div>
    </div>
</div>