import pandas as pd

# 1. Membaca file dataset ulasan
df = pd.read_csv("dataset_preprocessed.csv")

# 2. Fungsi untuk mengklasifikasikan sentimen berdasarkan rating
def sentiment_by_rating(rating):
    if rating <= 2:
        return 'Negatif'
    elif rating == 3:
        return 'Netral'
    else:
        return 'Positif'

# 3. Menerapkan fungsi pelabelan ke kolom 'Rating'
df['Sentimen_Rating'] = df['Rating'].apply(sentiment_by_rating)


# 4. Menyimpan hasil ke file CSV
output_filename = 'dataset_ulasan_berlabel.csv'
df.to_csv(output_filename, index=False)
print(f"\nFile berhasil disimpan dengan nama: {output_filename}")
