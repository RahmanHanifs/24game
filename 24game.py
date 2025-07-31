import random
import tkinter as tk
from tkinter import messagebox

class Game24GUI:
    def __init__(self, root):
        self.root = root
        self.root.title("Game 24")
        self.root.geometry("400x300")
        
        self.numbers = []
        self.create_widgets()
        self.new_game()

    def create_widgets(self):
        # Frame untuk angka yang diberikan
        self.numbers_frame = tk.Frame(self.root)
        self.numbers_frame.pack(pady=20)
        
        self.number_labels = []
        for i in range(4):
            label = tk.Label(self.numbers_frame, text="", font=("Arial", 24), width=3, relief="ridge")
            label.grid(row=0, column=i, padx=10)
            self.number_labels.append(label)
        
        # Input ekspresi
        self.input_label = tk.Label(self.root, text="Masukkan ekspresi:", font=("Arial", 12))
        self.input_label.pack()
        
        self.entry = tk.Entry(self.root, font=("Arial", 14), width=25)
        self.entry.pack(pady=10)
        self.entry.bind("<Return>", self.check_solution)
        
        # Tombol
        self.button_frame = tk.Frame(self.root)
        self.button_frame.pack(pady=10)
        
        self.check_button = tk.Button(self.button_frame, text="Cek", command=self.check_solution)
        self.check_button.grid(row=0, column=0, padx=5)
        
        self.new_button = tk.Button(self.button_frame, text="Game Baru", command=self.new_game)
        self.new_button.grid(row=0, column=1, padx=5)
        
        self.hint_button = tk.Button(self.button_frame, text="Hint", command=self.show_hint)
        self.hint_button.grid(row=0, column=2, padx=5)

    def new_game(self):
        self.numbers = [random.randint(1, 9) for _ in range(4)]
        for i in range(4):
            self.number_labels[i].config(text=str(self.numbers[i]))
        self.entry.delete(0, tk.END)
        
    def check_solution(self, event=None):
        expression = self.entry.get()
        
        # Cek penggunaan angka
        used_numbers = [int(n) for n in expression if n.isdigit()]
        if sorted(used_numbers) != sorted(self.numbers):
            messagebox.showerror("Error", "Anda harus menggunakan keempat angka yang diberikan!")
            return
            
        # Evaluasi ekspresi
        try:
            result = eval(expression)
        except:
            messagebox.showerror("Error", "Ekspresi matematika tidak valid!")
            return
            
        if abs(result - 24) < 1e-6:
            messagebox.showinfo("Selamat!", "Anda berhasil mendapatkan 24!")
            self.new_game()
        else:
            messagebox.showwarning("Coba Lagi", f"Hasilnya adalah {result}, bukan 24")

    def show_hint(self):
        hints = [
            "Coba gunakan pengelompokan dengan tanda kurung",
            "Perkalian dan pembagian sering membantu",
            f"Coba kombinasikan {self.numbers[0]} dan {self.numbers[1]} terlebih dahulu",
            "24 adalah 6×4, 8×3, atau 12×2. Cari cara mendapatkan angka-angka tersebut"
        ]
        messagebox.showinfo("Hint", random.choice(hints))

if __name__ == "__main__":
    root = tk.Tk()
    game = Game24GUI(root)
    root.mainloop()