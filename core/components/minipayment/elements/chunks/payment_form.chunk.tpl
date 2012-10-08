<h3>Произвольный платеж</h3>
<form method="post" action="[[~[[*id]]]]" class="form-horizontal">
	<div class="control-group">
		<label class="control-label" for="amount">Сумма</label>
		<div class="controls">
			<input type="number" name="sum" id="amount" value="[[+sum:default=`500`]]" class="span1" min="10" max="10000"/> руб.
		</div>
	</div>
	
	<div class="control-group">
		<label class="control-label" for="desc">Метод оплаты</label>
		<div class="controls">
			[[+methods]]
		</div>
	</div>
	
	<div class="control-group">
		<label class="control-label" for="desc">Примечание</label>
		<div class="controls">
			<textarea name="description" id="desc">[[+description]]</textarea>
		</div>
	</div>
	
	<div class="form-actions">
		<button type="submit" class="btn">Отправить</button>
	</div>
	<p><small>Вы будете перенаправлены на платежного агрегатора, где сможете выбрать подходящий способ оплаты.</small></p>
	
	<input type="hidden" name="action" value="createOperation" />
	
	<div class="alert alert-block alert-error [[+error:empty=`hidden`]]">
		<p>[[+error]]</p>
	</div>
</form>