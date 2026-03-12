<tr>
    <td><?= $trip['trip_id'] ?></td>
    <td>
        <?php if(!empty($trip['image'])): ?>
            <img src="<?= base_url('uploads/trips/'.$trip['image']) ?>" 
                 alt="<?= esc($trip['title']) ?>" 
                 style="width:50px; height:50px; object-fit:cover; border-radius:5px; margin-right:5px;">
        <?php endif; ?>
        <?= esc($trip['title']) ?>
    </td>
    <td><?= esc($trip['location']) ?></td>
    <td>Rp <?= number_format($trip['price'], 0, ',', '.') ?></td>
    <td><?= esc($trip['quota']) ?></td>
    <td>
        <a href="/admin/trips/edit/<?= $trip['trip_id'] ?>" 
           class="btn btn-warning btn-sm">
           Edit
        </a>

        <a href="/admin/trips/delete/<?= $trip['trip_id'] ?>" 
           class="btn btn-danger btn-sm" 
           onclick="return confirm('Hapus trip ini?')">
           Delete
        </a>
    </td>
</tr>