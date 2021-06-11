<?php if($meta_value_baohanh){ ?>
	<table class="variations" cellspacing="0">
		<tbody> 
			<tr>
				<td class="label"><label for="pa_goibaohanh">Gói bảo hành</label></td>
				<td class="value woo-variation-items-wrapper">
					<select class="form-control pa_select_goibaohanh" name="attribute_pa">
						<option value="0">Không chọn gói bảo hành</option> 
						<?php foreach ($meta_value_baohanh as $key=> $value) { ?>
							<option value="<?php echo $value[1]; ?>"><?php echo $value[0]; ?></option>
						<?php } ?>
					</select>

				</td>

			</tr>

		</tbody>

	</table>
<?php } ?>