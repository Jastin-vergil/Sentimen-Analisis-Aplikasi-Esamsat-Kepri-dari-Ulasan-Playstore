import re
import pandas as pd
from Sastrawi.Stemmer.StemmerFactory import StemmerFactory
from Sastrawi.StopWordRemover.StopWordRemoverFactory import StopWordRemoverFactory

# 1. Baca data
dataset = pd.read_csv("dataset_ulasan_berlabel.csv")

# 2. Kamus slang
SLANG = {
    "gk": "tidak", "ga": "tidak", "gak": "tidak", "nggak": "tidak", "ngga": "tidak",
    "ndak": "tidak", "nda": "tidak", "ngk": "tidak", "ngak": "tidak",
    "tdk": "tidak", "yg": "yang", "dgn": "dengan", "utk": "untuk", "krn": "karena",
    "udh": "sudah", "udah": "sudah", "sdh": "sudah", "blm": "belum", "bgt": "banget",
    "bs": "bisa", "bsa": "bisa", "jg": "juga", "aja": "saja", "tp": "tetapi",
    "tpi": "tetapi", "trs": "terus", "mulu": "terus", "lg": "lagi", "dr": "dari",
    "sy": "saya", "apk": "aplikasi", "app": "aplikasi", "eror": "error",
    "pls": "tolong", "plz": "tolong", "skrng": "sekarang", "diperbaharui": "diperbarui",
}

# Kata negasi
NEGASI = {"tidak", "bukan", "belum", "jangan", "tak", "kurang"}

stemmer = StemmerFactory().create_stemmer()
stopwords = set(StopWordRemoverFactory().get_stop_words()) - NEGASI

def preprocess(teks):
    teks = str(teks).lower()                          # 1. case folding
    teks = re.sub(r"http\S+|www\.\S+", " ", teks)     # 2. hapus URL
    teks = re.sub(r"[^a-z\s]", " ", teks)             # 3. hapus angka, emoji, tanda baca
    teks = re.sub(r"(.)\1{2,}", r"\1", teks)          #    "bagusss" -> "bagus"
    token = teks.split()                               # 4. tokenizing
    token = [SLANG.get(t, t) for t in token]           # 5. normalisasi slang
    token = [t for t in token if t not in stopwords]   # 6. stopword removal
    token = [stemmer.stem(t) for t in token]           # 7. stemming
    return " ".join(t for t in token if t)

# 3. Terapkan ke semua ulasan
dataset["teks_bersih"] = dataset["Teks"].apply(preprocess)

# 4. Simpan hasilnya
dataset.to_csv("dataset_preprocessed_test.csv", index=False)
print(dataset[["Teks", "teks_bersih"]].head())
