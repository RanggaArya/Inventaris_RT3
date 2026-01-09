<style>
                    /* Menyembunyikan Header Bawaan */
                    .fi-sidebar-header { 
                        display: none !important; 
                    }
                    
                    /* PERBAIKAN: Menyembunyikan semua isi footer KECUALI custom component kita */
                    /* Selector ini berarti: Pilih semua anak langsung dari .fi-sidebar-footer */
                    /* yang TIDAK memiliki class .custom-sidebar-footer, lalu sembunyikan. */
                    .fi-sidebar-footer > *:not(.custom-sidebar-footer) {
                        display: none !important;
                    }
                </style>