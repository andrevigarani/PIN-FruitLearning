import sys
import pickle
import pandas as pd

def process_file(input_file, model_file, output_file):
    # Carregar o modelo
    with open(model_file, 'rb') as f:
        scaler, model = pickle.load(f)

    # Verificar se o modelo carregado é uma instância de um classificador
    if not hasattr(model, 'predict'):
        raise ValueError("O objeto carregado não é um modelo de classificador válido.")

    # Carregar o arquivo de entrada
    data = pd.read_csv(input_file)

    # Aplicar o scaler aos dados
    data_scaled = scaler.transform(data)

    # Processar os dados
    predictions = model.predict(data_scaled)

    data['prediction'] = predictions

    # Salvar as previsões no mesmo arquivo de saída
    data.to_csv(output_file, index=False)

if __name__ == '__main__':
    input_file = sys.argv[1]
    model_file = sys.argv[2]
    output_file = sys.argv[3]
    process_file(input_file, model_file, output_file)
