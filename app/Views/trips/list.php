<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
     @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');

     * {
          margin: 0;
          padding: 0;
          box-sizing: border-box;
     }

     body {
          font-family: 'Inter', sans-serif;
          background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
     }

     .trips-container {
          max-width: 1200px;
          margin: 0 auto;
          padding: 40px 20px;
     }

     /* Page Header */
     .page-header {
          text-align: center;
          margin-bottom: 50px;
     }

     .page-header h2 {
          font-size: 2.2rem;
          font-weight: 800;
          color: #0f172a;
          position: relative;
          display: inline-block;
          margin-bottom: 15px;
          text-transform: capitalize;
     }

     .page-header h2:after {
          content: '';
          position: absolute;
          bottom: -10px;
          left: 50%;
          transform: translateX(-50%);
          width: 60px;
          height: 4px;
          background: linear-gradient(135deg, #c4603a, #b5532c);
          border-radius: 2px;
     }

     .page-header p {
          color: #64748b;
          font-size: 1rem;
          margin-top: 20px;
     }

     /* Trip Card */
     .trip-card {
          background: white;
          border-radius: 20px;
          overflow: hidden;
          transition: all 0.3s ease;
          box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
          height: 100%;
          display: flex;
          flex-direction: column;
     }

     .trip-card:hover {
          transform: translateY(-8px);
          box-shadow: 0 20px 30px -12px rgba(0, 0, 0, 0.15);
     }

     /* Image Wrapper */
     .image-wrapper {
          position: relative;
          overflow: hidden;
          height: 220px;
     }

     .image-wrapper img {
          width: 100%;
          height: 100%;
          object-fit: cover;
          transition: transform 0.5s ease;
     }

     .trip-card:hover .image-wrapper img {
          transform: scale(1.08);
     }

     /* Badge Styles */
     .trip-badge {
          position: absolute;
          top: 15px;
          right: 15px;
          padding: 5px 12px;
          border-radius: 50px;
          font-size: 0.7rem;
          font-weight: 600;
          z-index: 2;
          box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
          display: flex;
          align-items: center;
          gap: 5px;
     }

     .badge-open-trip {
          background: linear-gradient(135deg, #c4603a, #b5532c);
          color: white;
     }

     .badge-private-trip {
          background: linear-gradient(135deg, #3b82f6, #2563eb);
          color: white;
     }

     .badge-one-day-trip {
          background: linear-gradient(135deg, #10b981, #059669);
          color: white;
     }

     /* Card Body */
     .card-body-custom {
          padding: 20px;
          flex: 1;
          display: flex;
          flex-direction: column;
     }

     .card-title {
          font-size: 1.2rem;
          font-weight: 700;
          color: #0f172a;
          margin-bottom: 12px;
          line-height: 1.4;
     }

     /* Info Items */
     .info-item {
          display: flex;
          align-items: center;
          gap: 10px;
          margin-bottom: 10px;
          color: #475569;
          font-size: 0.85rem;
     }

     .info-item i {
          width: 20px;
          color: #c4603a;
          font-size: 0.9rem;
     }

     .price {
          font-size: 1.3rem;
          font-weight: 800;
          color: #c4603a;
          margin: 12px 0 8px;
     }

     .quota {
          display: inline-block;
          background: #f1f5f9;
          padding: 4px 12px;
          border-radius: 50px;
          font-size: 0.75rem;
          font-weight: 500;
          color: #64748b;
          margin-bottom: 15px;
     }

     /* Button */
     .btn-detail {
          background: linear-gradient(135deg, #c4603a, #b5532c);
          color: white;
          border: none;
          padding: 12px;
          border-radius: 12px;
          font-weight: 600;
          font-size: 0.9rem;
          cursor: pointer;
          transition: all 0.2s;
          text-align: center;
          text-decoration: none;
          display: block;
          width: 100%;
     }

     .btn-detail:hover {
          transform: translateY(-2px);
          box-shadow: 0 5px 15px rgba(196, 96, 58, 0.3);
          color: white;
     }

     .btn-disabled {
          background: #e2e8f0;
          color: #94a3b8;
          cursor: not-allowed;
          border: none;
          padding: 12px;
          border-radius: 12px;
          font-weight: 600;
          font-size: 0.9rem;
          text-align: center;
          display: block;
          width: 100%;
     }

     /* Empty State */
     .empty-state {
          text-align: center;
          padding: 60px 20px;
          background: white;
          border-radius: 24px;
          box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
     }

     .empty-state i {
          font-size: 4rem;
          color: #cbd5e1;
          margin-bottom: 20px;
     }

     .empty-state p {
          color: #64748b;
          font-size: 1rem;
          margin-bottom: 0;
     }

     /* Grid */
     .trips-grid {
          display: grid;
          grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
          gap: 30px;
     }

     /* Responsive */
     @media (max-width: 768px) {
          .trips-container {
               padding: 30px 20px;
          }

          .page-header h2 {
               font-size: 1.6rem;
          }

          .trips-grid {
               grid-template-columns: 1fr;
               gap: 20px;
          }

          .image-wrapper {
               height: 200px;
          }

          .card-title {
               font-size: 1.1rem;
          }
     }
</style>

<div class="trips-container">
     <div class="page-header">
          <h2><?= esc($type ?? 'Semua Trip') ?></h2>
          <p>Temukan petualangan seru bersama BLNTRK OUTDOOR</p>
     </div>

     <div class="trips-grid">
          <?php if (!empty($trips)): ?>
               <?php foreach ($trips as $trip): ?>
                    <div class="trip-card">
                         <div class="image-wrapper">
                              <?php if (!empty($trip['image'])): ?>
                                   <img src="<?= base_url('uploads/trips/' . $trip['image']) ?>"
                                        alt="<?= esc($trip['title']) ?>"
                                        loading="lazy">
                              <?php else: ?>
                                   <img src="<?= base_url('assets/images/no-image.jpg') ?>"
                                        alt="No Image"
                                        loading="lazy">
                              <?php endif; ?>

                              <!-- Badge berdasarkan kategori trip -->
                              <div class="trip-badge 
                            <?php
                              if (isset($trip['type'])) {
                                   if ($trip['type'] == 'private_trip') {
                                        echo 'badge-private-trip';
                                   } elseif ($trip['type'] == 'one_day_trip') {
                                        echo 'badge-one-day-trip';
                                   } else {
                                        echo 'badge-open-trip';
                                   }
                              } else {
                                   echo 'badge-open-trip';
                              }
                              ?>">
                                   <i class="fas 
                                <?php
                                   if (isset($trip['type'])) {
                                        if ($trip['type'] == 'private_trip') {
                                             echo 'fa-lock';
                                        } elseif ($trip['type'] == 'one_day_trip') {
                                             echo 'fa-sun';
                                        } else {
                                             echo 'fa-flag-checkered';
                                        }
                                   } else {
                                        echo 'fa-flag-checkered';
                                   }
                                   ?>">
                                   </i>
                                   <?php
                                   if (isset($trip['type'])) {
                                        if ($trip['type'] == 'private_trip') {
                                             echo 'Private Trip';
                                        } elseif ($trip['type'] == 'one_day_trip') {
                                             echo 'One Day Trip';
                                        } else {
                                             echo 'Open Trip';
                                        }
                                   } else {
                                        echo 'Open Trip';
                                   }
                                   ?>
                              </div>
                         </div>

                         <div class="card-body-custom">
                              <h5 class="card-title"><?= esc($trip['title']) ?></h5>

                              <div class="info-item">
                                   <i class="fas fa-map-marker-alt"></i>
                                   <span><?= esc($trip['location']) ?></span>
                              </div>

                              <div class="info-item">
                                   <i class="fas fa-calendar-alt"></i>
                                   <span>
                                        <?= !empty($trip['departure_date'])
                                             ? date('d M Y', strtotime($trip['departure_date']))
                                             : 'Jadwal belum tersedia' ?>
                                   </span>
                              </div>

                              <div class="price">
                                   Rp <?= number_format($trip['price'], 0, ',', '.') ?>
                              </div>

                              <div class="quota">
                                   <i class="fas fa-users"></i> Kuota: <?= !empty($trip['quota']) ? esc($trip['quota']) : '-' ?> orang
                              </div>

                              <div class="mt-auto">
                                   <?php if (!empty($trip['schedule_id'])): ?>
                                        <a href="<?= base_url('trips/detail/' . $trip['schedule_id']) ?>"
                                             class="btn-detail">
                                             <i class="fas fa-eye me-2"></i> Lihat Detail
                                        </a>
                                   <?php else: ?>
                                        <div class="btn-disabled">
                                             <i class="fas fa-clock me-2"></i> Jadwal Belum Tersedia
                                        </div>
                                   <?php endif; ?>
                              </div>
                         </div>
                    </div>
               <?php endforeach; ?>
          <?php else: ?>
               <div class="empty-state">
                    <i class="fas fa-mountain"></i>
                    <p>Tidak ada trip tersedia untuk kategori ini.</p>
               </div>
          <?php endif; ?>
     </div>
</div>

<?= $this->endSection() ?>