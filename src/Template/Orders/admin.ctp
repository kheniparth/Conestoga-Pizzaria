<!-- File: src/Template/Articles/admin.ctp -->
<div class="row" id="logo">
        <h1>Conestoga Pizzeria</h1>
    </div>
	
	<div class="container-fluid">        
		<div class="row">
         <?= $this->Html->link('Logout', ['action' => 'login']) ?>
        <h1> Orders </h1>
        <table>
            <tr>
                <th>Id</th>
                <th>Status</th>
                <th>Customer Name</th>
                <th>Address</th>
                <th>View</th>
                <th>Cancle</th>
                <th>Complete</th>
            </tr>

            <!-- Here is where we iterate through our $articles query object, printing out article info -->

            <?php foreach ($orders as $order): ?>
            <tr>
                <td><?= $order->id ?></td>
                <td><?= $order->status ?></td>
                <td>
                    <?= $this->Html->link($order->name, ['action' => 'view', $order->id]) ?>       
                </td>
                <td>
                    <?= h($order->address) ?> <?= h($order->city) ?> <?= h($order->postalCode) ?>
                </td>
                <td>
                    <?= $this->Html->link('View', ['action' => 'view', $order->id]) ?>       
                </td>
                <td>
                    <?= $this->Form->postLink(
                        'Delete',
                        ['action' => 'delete', $order->id],
                        ['confirm' => 'Are you sure?'])
                    ?>
                </td>
                <td>
                    <?= $this->Form->postLink(
                        'Complete',
                        ['action' => 'complete', $order->id],
                        ['confirm' => 'Are you sure?'])
                    ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <div class="submitButton">
            <?= $this->Html->link('Logout', ['action' => 'login']) ?>
        </div>
    </div>
</div>