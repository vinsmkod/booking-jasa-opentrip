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
          max-width: 1280px;
          margin: 0 auto;
          padding: 60px 24px;
     }

     /* Page Header */
     .page-header {
          margin-bottom: 60px;
     }

     .page-header h2 {
          font-size: 2.5rem;
          font-weight: 800;
          color: #0f172a;
          margin-bottom: 12px;
          letter-spacing: -0.5px;
     }

     .page-header p {
          color: #64748b;
          font-size: 1.1rem;
          line-height: 1.6;
          max-width: 600px;
     }

     /* Filter Section */
     .filter-section {
          display: flex;
          gap: 12px;
          margin-bottom: 40px;
          flex-wrap: wrap;
          align-items: center;
     }

     .filter-badge {
          padding: 8px 16px;
          border-radius: 50px;
          font-size: 0.9rem;
          font-weight: 500;
          border: 2px solid #e2e8f0;
          background: white;
          color: #475569;
          cursor: pointer;
          transition: all 0.2s;
     }

     .filter-badge:hover {
          border-color: #2d7d3a;
          background: #f0fdf4;
          color: #2d7d3a;
     }

     .filter-badge.active {
          background: #2d7d3a;
          border-color: #2d7d3a;
          color: white;
     }

     /* Trip Card */
     .trip-card {
          background: white;
          border-radius: 16px;
          overflow: hidden;
          transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
          box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
          height: 100%;
          display: flex;
          flex-direction: column;
          border: 1px solid #f1f5f9;
     }

     .trip-card:hover {
          transform: translateY(-8px);
          box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
          border-color: #e0e7ff;
     }

     /* Image Wrapper */
     .image-wrapper {
          position: relative;
          overflow: hidden;
          height: 240px;
          background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
     }

     .image-wrapper img {
          width: 100%;
          height: 100%;
          object-fit: cover;
          transition: transform 0.4s ease;
     }

     .trip-card:hover .image-wrapper img {
          transform: scale(1.06);
     }

     /* Badge Styles */
     .trip-badge {
          position: absolute;
          top: 16px;
          right: 16px;
          padding: 6px 14px;
          border-radius: 50px;
          font-size: 0.75rem;
          font-weight: 700;
          z-index: 2;
          box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
          display: flex;
          align-items: center;
          gap: 6px;
          text-transform: uppercase;
          letter-spacing: 0.5px;
     }

     .badge-open-trip {
          background: linear-gradient(135deg, #dc2626, #b91c1c);
          color: white;
     }

     .badge-private-trip {
          background: linear-gradient(135deg, #3b82f6, #1d4ed8);
          color: white;
     }

     .badge-one-day-trip {
          background: linear-gradient(135deg, #10b981, #047857);
          color: white;
     }

     /* Status Badge */
     .status-badge {
          position: absolute;
          bottom: 16px;
          left: 16px;
          padding: 6px 12px;
          border-radius: 50px;
          font-size: 0.7rem;
          font-weight: 600;
          background: rgba(255, 255, 255, 0.95);
          backdrop-filter: blur(10px);
          color: #0f172a;
          display: flex;
          align-items: center;
          gap: 5px;
     }

     .status-available {
          background: rgba(16, 185, 129, 0.95);
          color: white;
     }

     /* Card Body */
     .card-body-custom {
          padding: 24px;
          flex: 1;
          display: flex;
          flex-direction: column;
     }

     .card-title {
          font-size: 1.25rem;
          font-weight: 700;
          color: #0f172a;
          margin-bottom: 14px;
          line-height: 1.4;
          display: -webkit-box;
          -webkit-line-clamp: 2;
          -webkit-box-orient: vertical;
          overflow: hidden;
     }

     .card-description {
          color: #64748b;
          font-size: 0.9rem;
          line-height: 1.5;
          margin-bottom: 16px;
          display: -webkit-box;
          -webkit-line-clamp: 2;
          -webkit-box-orient: vertical;
          overflow: hidden;
     }

     /* Info Items */
     .info-row {
          display: grid;
          grid-template-columns: 1fr 1fr;
          gap: 12px;
          margin-bottom: 16px;
     }

     .info-item {
          display: flex;
          align-items: center;
          gap: 8px;
          color: #475569;
          font-size: 0.85rem;
          font-weight: 500;
     }

     .info-item i {
          width: 18px;
          min-width: 18px;
          color: #2d7d3a;
          font-size: 0.95rem;
     }

     /* Price Section */
     .price-section {
          border-top: 1px solid #f1f5f9;
          padding-top: 14px;
          margin-bottom: 16px;
     }

     .price {
          font-size: 1.4rem;
          font-weight: 800;
          color: #2d7d3a;
     }

     .price-label {
          font-size: 0.75rem;
          color: #94a3b8;
          text-transform: uppercase;
          letter-spacing: 0.5px;
          font-weight: 600;
          margin-bottom: 4px;
     }

     /* Button */
     .btn-detail {
          background: linear-gradient(135deg, #2d7d3a 0%, #1f5428 100%);
          color: white;
          border: none;
          padding: 12px 16px;
          border-radius: 10px;
          font-weight: 600;
          font-size: 0.9rem;
          cursor: pointer;
          transition: all 0.2s;
          text-align: center;
          text-decoration: none;
          display: flex;
          align-items: center;
          justify-content: center;
          gap: 8px;
          width: 100%;
     }

     .btn-detail:hover {
          transform: translateY(-2px);
          box-shadow: 0 6px 20px rgba(45, 125, 58, 0.3);
          color: white;
          text-decoration: none;
     }

     .btn-disabled {
          background: #f1f5f9;
          color: #94a3b8;
          cursor: not-allowed;
          border: 1px dashed #cbd5e1;
          padding: 12px 16px;
          border-radius: 10px;
          font-weight: 600;
          font-size: 0.9rem;
          text-align: center;
          display: flex;
          align-items: center;
          justify-content: center;
          gap: 8px;
          width: 100%;
     }

     /* Empty State */
     .empty-state {
          text-align: center;
          padding: 80px 40px;
          background: white;
          border-radius: 20px;
          box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
          border: 1px solid #f1f5f9;
     }

     .empty-state i {
          font-size: 4rem;
          color: #cbd5e1;
          margin-bottom: 20px;
     }

     .empty-state h3 {
          font-size: 1.3rem;
          color: #0f172a;
          margin-bottom: 10px;
          font-weight: 700;
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
          gap: 28px;
     }

     /* Responsive */
     @media (max-width: 768px) {
          .trips-container {
               padding: 40px 16px;
          }

          .page-header h2 {
               font-size: 1.8rem;
          }

          .page-header p {
               font-size: 1rem;
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

          .info-row {
               grid-template-columns: 1fr;
          }

          .filter-section {
               gap: 8px;
          }

          .filter-badge {
               padding: 6px 12px;
               font-size: 0.85rem;
          }
     }

     @media (max-width: 480px) {
          .trips-container {
               padding: 30px 12px;
          }

          .page-header h2 {
               font-size: 1.5rem;
          }

          .card-body-custom {
               padding: 16px;
          }

          .info-item {
               font-size: 0.8rem;
          }
     }
</style>

<div class="trips-container">
     <!-- Page Header -->
     <div class="page-header">
          <h2><?= esc($type ?? 'Jelajahi Petualangan') ?></h2>
          <p>Temukan destinasi impian Anda dengan paket tur profesional dari BLNTRK OUTDOOR</p>
     </div>

     <!-- Trip Grid -->
     <div class="trips-grid">
          <?php if (!empty($trips)): ?>
               <?php foreach ($trips as $trip): 
                    $isAvailable = !empty($trip['schedule_id']) && !empty($trip['quota']) && $trip['quota'] > 0;
               ?>
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

                              <!-- Type Badge -->
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
                                             echo 'fa-route';
                                        }
                                   } else {
                                        echo 'fa-route';
                                   }
                                   ?>"></i>
                                   <?php
                                   if (isset($trip['type'])) {
                                        if ($trip['type'] == 'private_trip') {
                                             echo 'Private';
                                        } elseif ($trip['type'] == 'one_day_trip') {
                                             echo '1 Hari';
                                        } else {
                                             echo 'Open';
                                        }
                                   } else {
                                        echo 'Open';
                                   }
                                   ?>
                              </div>

                              <!-- Status Badge -->
                              <?php if ($isAvailable): ?>
                                   <div class="status-badge status-available">
                                        <i class="fas fa-check-circle"></i> Tersedia
                                   </div>
                              <?php endif; ?>
                         </div>

                         <div class="card-body-custom">
                              <h5 class="card-title"><?= esc($trip['title']) ?></h5>

                              <?php if (!empty($trip['description'])): ?>
                                   <p class="card-description"><?= esc(substr($trip['description'], 0, 80)) ?>...</p>
                              <?php endif; ?>

                              <div class="info-row">
                                   <div class="info-item">
                                        <i class="fas fa-map-marker-alt"></i>
                                        <span><?= esc($trip['location']) ?></span>
                                   </div>
                                   <div class="info-item">
                                        <i class="fas fa-users"></i>
                                        <span><?= !empty($trip['quota']) ? $trip['quota'] . ' orang' : '-' ?></span>
                                   </div>
                              </div>

                              <div class="info-row">
                                   <div class="info-item">
                                        <i class="fas fa-calendar-alt"></i>
                                        <span>
                                             <?= !empty($trip['departure_date'])
                                                  ? date('d M Y', strtotime($trip['departure_date']))
                                                  : 'Jadwal belum tersedia' ?>
                                        </span>
                                   </div>
                              </div>

                              <div class="price-section">
                                   <div class="price-label">Harga Mulai</div>
                                   <div class="price">
                                        Rp <?= number_format($trip['price'], 0, ',', '.') ?>
                                   </div>
                              </div>

                              <div class="mt-auto">
                                   <?php if ($isAvailable): ?>
                                        <a href="<?= base_url('trips/detail/' . $trip['schedule_id']) ?>"
                                             class="btn-detail">
                                             <i class="fas fa-arrow-right"></i> Lihat Detail
                                        </a>
                                   <?php else: ?>
                                        <div class="btn-disabled">
                                             <i class="fas fa-clock"></i> Tidak Tersedia
                                        </div>
                                   <?php endif; ?>
                              </div>
                         </div>
                    </div>
               <?php endforeach; ?>
          <?php else: ?>
               <div class="empty-state" style="grid-column: 1/-1;">
                    <i class="fas fa-mountain"></i>
                    <h3>Belum Ada Trip</h3>
                    <p>Tidak ada trip tersedia untuk kategori ini. Silakan cek kembali nanti.</p>
               </div>
          <?php endif; ?>
     </div>
</div>

<?= $this->endSection() ?>